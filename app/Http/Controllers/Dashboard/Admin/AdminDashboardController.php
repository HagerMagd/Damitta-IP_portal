<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Models\BlockchainLogs;
use App\Models\researche;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // =========================================
        // 1. USERS STATISTICS
        // =========================================

        $totalUsers = User::count();

        $studentsCount = User::where('role', 'student')->count();

        $executiveCount = User::where('role', 'executive')->count();

        $committeeMembersCount = User::where(
            'role',
            'committee_member'
        )->count();

        $ethicsMembersCount = User::where(
            'role',
            'ethics_member'
        )->count();

        $adminsCount = User::where('role', 'admin')->count();


        // =========================================
        // 2. RESEARCH STATISTICS
        // =========================================

        $totalResearches = researche::count();

        $pendingCount = researche::where(
            'status',
            'pending'
        )->count();

        $underReviewCount = researche::where(
            'status',
            'under_review'
        )->count();

        $approvedCount = researche::where(
            'status',
            'approved'
        )->count();

        $rejectedCount = researche::where(
            'status',
            'rejected'
        )->count();


        // Approval rate = approved / all researches * 100
        $approvalRate = $totalResearches > 0
            ? round(($approvedCount / $totalResearches) * 100, 1)
            : 0;


        // =========================================
        // 3. LATEST RESEARCHES
        // =========================================

        $researchs = researche::with([
            'user',
            'committee.specialization',
            'researchesfiles',
            'blockchain_logs',
            'decision',
        ])
            ->latest()
            ->take(5)
            ->get();


        // =========================================
        // 4. BLOCKCHAIN STATISTICS
        // =========================================

        $totalTransactions = BlockchainLogs::count();

        $uploadCount = BlockchainLogs::where(
            'type',
            'upload'
        )->count();

        // Number of distinct researches with at least one upload log
        $verifiedResearchesCount = BlockchainLogs::where(
            'type',
            'upload'
        )
            ->distinct()
            ->count('research_id');

        $latestTransaction = BlockchainLogs::with('research')
            ->latest()
            ->first();

        $blockchainLogs = BlockchainLogs::with('research')
            ->latest()
            ->take(5)
            ->get();


        // =========================================
        // 5. MONTHLY RESEARCH SUBMISSIONS
        // =========================================

        $year = (int) $request->input('year', now()->year);

        // Accept a reasonable year range
        if ($year < 2000 || $year > now()->year + 1) {
            $year = now()->year;
        }

        $monthlyTotals = researche::query()
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'month');

        // Always return all 12 months, including months with zero submissions
        $monthlySubmissions = collect(range(1, 12))->map(
            function ($month) use ($monthlyTotals) {
                return [
                    'month' => $month,
                    'total' => (int) ($monthlyTotals[$month] ?? 0),
                ];
            }
        );

        $maxMonthlySubmissions = max(
            1,
            (int) $monthlySubmissions->max('total')
        );


        // =========================================
        // 6. USERS TABLE: SEARCH + ROLE FILTER + PAGINATION
        // =========================================

        $search = trim((string) $request->input('search', ''));

        $role = (string) $request->input('role', '');

        $allowedRoles = [
            'student',
            'committee_member',
            'ethics_member',
            'executive',
            'admin',
        ];

        $usersQuery = User::with('specialization')
            ->latest();

        if ($search !== '') {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if (in_array($role, $allowedRoles, true)) {
            $usersQuery->where('role', $role);
        }

        $users = $usersQuery
            ->paginate(4)
            ->withQueryString();


        // =========================================
        // 7. RECENT ACTIVITY
        // Based on real research and blockchain records
        // =========================================

        $recentActivities = researche::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($research) {
                return [
                    'title' => 'Research status updated',
                    'description' => $research->title,
                    'created_at' => $research->updated_at,
                    'icon' => 'fa-file-shield',
                    'color' => 'icon-blue',
                ];
            })
            ->concat(
                BlockchainLogs::with('research')
                    ->latest()
                    ->take(5)
                    ->get()
                    ->map(function ($log) {
                        return [
                            'title' => 'Blockchain activity: ' . $log->type,
                            'description' => $log->research?->title
                                ?? 'Research no longer available',
                            'created_at' => $log->created_at,
                            'icon' => 'fa-link',
                            'color' => 'icon-gold',
                        ];
                    })
            )
            ->sortByDesc('created_at')
            ->take(5)
            ->values();


        // =========================================
        // 8. ADMIN PROFILE
        // =========================================

        $admin = $request->user();


        // =========================================
        // 9. RETURN DASHBOARD
        // =========================================

        return view('dashboard.admin.index', compact(
            'totalUsers',
            'studentsCount',
            'executiveCount',
            'committeeMembersCount',
            'ethicsMembersCount',
            'adminsCount',
            'totalResearches',
            'pendingCount',
            'underReviewCount',
            'approvedCount',
            'rejectedCount',
            'approvalRate',
            'researchs',
            'totalTransactions',
            'uploadCount',
            'verifiedResearchesCount',
            'latestTransaction',
            'blockchainLogs',
            'year',
            'monthlySubmissions',
            'maxMonthlySubmissions',
            'users',
            'search',
            'role',
            'recentActivities',
            'admin'
        ));
    }


    // =============================================
    // EXPORT RESEARCH REPORT AS CSV
    // =============================================

    public function exportReport(): StreamedResponse
    {
        $fileName = 'research-report-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () {
            $output = fopen('php://output', 'w');

            // UTF-8 BOM for proper Arabic display in Excel
            fwrite($output, "\xEF\xBB\xBF");

            fputcsv($output, [
                'ID',
                'Title',
                'Owner',
                'Status',
                'Created At',
                'Research Hash',
            ]);

            researche::with('user')
                ->orderBy('id')
                ->chunk(200, function ($researches) use ($output) {
                    foreach ($researches as $research) {
                        fputcsv($output, [
                            $research->id,
                            $research->title,
                            $research->user?->name ?? '',
                            $research->status,
                            $research->created_at?->format('Y-m-d H:i:s'),
                            $research->hash,
                        ]);
                    }
                });

            fclose($output);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
