<input type="checkbox"
       id="addUserModal"
       class="modal-toggle">


<div class="css-modal">

    <div class="css-modal-dialog">


        <div class="css-modal-header">

            <h5>
                <i class="fa-solid fa-user-plus text-primary-custom me-2"></i>
                Add New User
            </h5>

            <label for="addUserModal"
                   class="modal-close">

                <i class="fa-solid fa-xmark"></i>

            </label>

        </div>


        <div class="css-modal-body">

            <div class="row g-3">


                <div class="col-md-6">

                    <label class="form-label">
                        Full Name
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Enter full name"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        class="form-control"
                        placeholder="name@damietta.edu.eg"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        class="form-control"
                        placeholder="••••••••"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        class="form-control"
                        placeholder="••••••••"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Role
                    </label>

                    <select class="form-select">

                        <option selected disabled>
                            Select role
                        </option>

                        <option>
                            Admin
                        </option>

                        <option>
                            Student
                        </option>

                        <option>
                            Executive
                        </option>

                        <option>
                            Committee
                        </option>

                        <option>
                            Ethics
                        </option>

                    </select>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Department
                    </label>

                    <select class="form-select">

                        <option selected disabled>
                            Select department
                        </option>

                        <option>
                            Medicine
                        </option>

                        <option>
                            Engineering
                        </option>

                        <option>
                            Science
                        </option>

                        <option>
                            Arts
                        </option>

                        <option>
                            Education
                        </option>

                        <option>
                            Law
                        </option>

                    </select>

                </div>


                <div class="col-12">

                    <label class="form-label">
                        Profile Image
                    </label>

                    <div class="upload-box">

                        <i class="fa-solid fa-image d-block"></i>

                        <strong style="font-size:11px;">
                            Upload profile image
                        </strong>

                        <small class="d-block mt-1">
                            JPG, PNG or WEBP · Maximum 2MB
                        </small>

                        <input
                            type="file"
                            class="form-control mt-3"
                        >

                    </div>

                </div>

            </div>

        </div>


        <div class="css-modal-footer">

            <label for="addUserModal"
                   class="btn btn-light"
                   style="
                   border:1px solid var(--border);
                   font-size:11px;
                   border-radius:9px;
                   ">

                Cancel

            </label>

            <button class="primary-btn">

                <i class="fa-solid fa-check me-1"></i>

                Save User

            </button>

        </div>

    </div>

</div>