@extends('layouts.dashboard.app')

@section('title', 'Submit Project')

@section('content')

<div class="submit-page">

    {{-- Page Header --}}
    <div class="submit-header">

        <div>
            <span class="page-badge">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                New Submission
            </span>

            <h1>Submit Your Project</h1>

            <p>
                Upload your research project and required documents
                for intellectual property protection.
            </p>
        </div>

        <div class="submit-header-icon">
            <i class="fa-solid fa-file-shield"></i>
        </div>

    </div>


    <form action="{{route('student.dashboard.projects.store')}}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row g-4">

            {{-- =========================
                 Project Information
            ========================== --}}

            <div class="col-lg-8">

                <div class="dashboard-card submit-card">

                    <div class="card-heading">

                        <div class="heading-icon">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>

                        <div>
                            <h4>Project Information</h4>

                            <p>
                                Enter the basic information about your project.
                            </p>
                        </div>

                    </div>


                    {{-- Title --}}

                    <div class="form-group mb-4">

                        <label for="title" class="form-label">
                            Project Title
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="form-control"
                            value="{{ old('title') }}"
                            placeholder="Enter your project title"
                        >

                        @error('title')
                            <div class="field-error">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Description --}}

                    <div class="form-group mb-4">

                        <label for="desc" class="form-label">
                            Project Description
                            <span class="required">*</span>
                        </label>

                        <textarea
                            id="desc"
                            name="desc"
                            class="form-control project-description"
                            rows="7"
                            placeholder="Describe your project, its purpose, objectives and main idea..."
                        >{{ old('desc') }}</textarea>

                        @error('desc')
                            <div class="field-error">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="input-hint">
                            <i class="fa-solid fa-circle-info"></i>
                            Provide a clear description of your project.
                        </div>

                    </div>

                </div>


                {{-- =========================
                     Required Documents
                ========================== --}}

                <div class="dashboard-card submit-card mt-4">

                    <div class="card-heading">

                        <div class="heading-icon">
                            <i class="fa-solid fa-folder-open"></i>
                        </div>

                        <div>
                            <h4>Required Documents</h4>

                            <p>
                                Upload the documents related to your project.
                            </p>
                        </div>

                    </div>


                    {{-- Main Research --}}

                    <div class="file-upload-box mb-4">

                        <div class="file-upload-info">

                            <div class="file-icon">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>

                            <div>

                                <label for="main_research" class="file-title">
                                    Main Research
                                    <span class="required">*</span>
                                </label>

                                <p>
                                    Upload the main research or project document.
                                </p>

                            </div>

                        </div>


                        <input
                            type="file"
                            id="main_research"
                            name="main_research"
                            accept=".pdf,.doc,.docx"
                            class="form-control"
                        >

                        @error('main_research')
                            <div class="field-error">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="file-hint">
                            PDF, DOC or DOCX
                        </small>

                    </div>


                    {{-- Registration Form --}}

                    <div class="file-upload-box mb-4">

                        <div class="file-upload-info">

                            <div class="file-icon">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>

                            <div>

                                <label for="registration_form" class="file-title">
                                    Registration Form
                                    <span class="required">*</span>
                                </label>

                                <p>
                                    Upload the project registration form.
                                </p>

                            </div>

                        </div>


                        <input
                            type="file"
                            id="registration_form"
                            name="registration_form"
                            accept=".pdf,.doc,.docx"
                            class="form-control"
                        >

                        @error('registration_form')
                            <div class="field-error">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="file-hint">
                            PDF, DOC or DOCX
                        </small>

                    </div>


                    {{-- Supporting Documents --}}

                    <div class="file-upload-box mb-4">

                        <div class="file-upload-info">

                            <div class="file-icon">
                                <i class="fa-solid fa-folder-plus"></i>
                            </div>

                            <div>

                                <label for="supporting_documents" class="file-title">
                                    Supporting Documents
                                </label>

                                <p>
                                    Upload any additional documents supporting your project.
                                </p>

                            </div>

                        </div>


                        <input
                            type="file"
                            id="supporting_documents"
                            name="supporting_documents[]"
                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                            class="form-control"
                            multiple
                        >

                        @error('supporting_documents')
                            <div class="field-error">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="file-hint">
                            You can select multiple files.
                        </small>

                    </div>


                    {{-- Ethics Document --}}

                    <div class="file-upload-box">

                        <div class="file-upload-info">

                            <div class="file-icon">
                                <i class="fa-solid fa-shield-heart"></i>
                            </div>

                            <div>

                                <label for="ethics_document" class="file-title">
                                    Ethics Document
                                </label>

                                <p>
                                    Upload the ethics approval or related document if required.
                                </p>

                            </div>

                        </div>


                        <input
                            type="file"
                            id="ethics_document"
                            name="ethics_document"
                            accept=".pdf,.doc,.docx"
                            class="form-control"
                        >

                        @error('ethics_document')
                            <div class="field-error">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="file-hint">
                            PDF, DOC or DOCX
                        </small>

                    </div>

                </div>

            </div>


            {{-- =========================
                 Submission Summary
            ========================== --}}

            <div class="col-lg-4">

                <div class="dashboard-card submission-summary">

                    <div class="summary-header">

                        <div class="summary-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>

                        <div>
                            <h4>Submission Process</h4>

                            <p>
                                What happens next?
                            </p>
                        </div>

                    </div>


                    <div class="process-step">

                        <div class="step-number">
                            1
                        </div>

                        <div>
                            <h6>Project Submission</h6>

                            <p>
                                Your project and documents are securely uploaded.
                            </p>
                        </div>

                    </div>


                    <div class="process-line"></div>


                    <div class="process-step">

                        <div class="step-number">
                            2
                        </div>

                        <div>
                            <h6>Committee Review</h6>

                            <p>
                                The assigned committee reviews your submission.
                            </p>
                        </div>

                    </div>


                    <div class="process-line"></div>


                    <div class="process-step">

                        <div class="step-number">
                            3
                        </div>

                        <div>
                            <h6>Approval</h6>

                            <p>
                                Your project is approved or returned for changes.
                            </p>
                        </div>

                    </div>


                    <div class="process-line"></div>


                    <div class="process-step">

                        <div class="step-number gold">
                            4
                        </div>

                        <div>
                            <h6>Blockchain Protection</h6>

                            <p>
                                Once approved, the project is documented on blockchain.
                            </p>
                        </div>

                    </div>

                </div>


                {{-- Security Notice --}}

                <div class="security-card mt-4">

                    <div class="security-icon">
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <div>

                        <h6>Your Data is Secure</h6>

                        <p>
                            Your submitted documents are securely stored
                            and protected by the platform.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
             Submit Actions
        ========================== --}}

        <div class="submit-actions">

            <a href="#" class="cancel-btn">
                Cancel
            </a>

            <button type="submit" class="submit-project-btn">

                <i class="fa-solid fa-cloud-arrow-up"></i>

                Submit Project

            </button>

        </div>

    </form>

</div>

@endsection