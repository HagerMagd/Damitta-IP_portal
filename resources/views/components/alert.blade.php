@if(session('success'))
    <div id="flash-message" class="flash-message success">

        <div class="flash-content">
            <i class="fas fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>
        </div>

        <button class="close-btn" onclick="closeFlash()">
            &times;
        </button>

    </div>
@endif


@if(session('error'))
    <div id="flash-message" class="flash-message error">

        <div class="flash-content">
            <i class="fas fa-circle-xmark"></i>

            <span>
                {{ session('error') }}
            </span>
        </div>

        <button class="close-btn" onclick="closeFlash()">
            &times;
        </button>

    </div>
@endif