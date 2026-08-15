<div class="row g-4 mb-5">

    <div class="col-lg-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon blue">
                <i class="fa-solid fa-folder-open"></i>
            </div>

            <div class="stat-info">

                <span>Total Projects</span>

                <h2>{{ auth()->user()->researchs()->count() }}</h2>

                <small>All submitted projects</small>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon orange">
                <i class="fa-solid fa-clock"></i>
            </div>

            <div class="stat-info">

                <span>Under Review</span>

                <h2>{{ auth()->user()->researchs()->where('status', 'under_review')->count() }}</h2>

                <small>Waiting committee review</small>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon green">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div class="stat-info">

                <span>Approved</span>

                <h2>{{ auth()->user()->researchs()->where('status', 'approved')->count() }}</h2>

                <small>Successfully approved</small>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon purple">
                <i class="fa-solid fa-certificate"></i>
            </div>

            <div class="stat-info">

                <span>Blockchain Certificates</span>

                <h2>{{ auth()->user()->researchs()->whereHas('decision',function($query){
                    $query->where('result','approved');
                }
                
                
                )->count()}}</h2>

                <small>Issued certificates</small>

            </div>

        </div>

    </div>

</div>
