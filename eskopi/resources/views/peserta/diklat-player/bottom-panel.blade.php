<div class="video_tabs_area">
    <ul class="nav nav-pills" id="pills-tab2" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                type="button" role="tab" aria-controls="pills-home"
                aria-selected="true">{{ __('Deskripsi') }}</button>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                type="button" role="tab" aria-controls="pills-profile"
                aria-selected="false">{{ __('Diskusi') }}</button>
        </li> -->
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
            tabindex="0">
            <div class="video_about">
                <h1 style="font-size: 18px;">{{ $diklat->nama_diklat }}</h1>
                <div class="about-lecture" style="font-size: 13px; text-align: justify;">{{ $diklat->deskripsi }}</div>
            </div>
    </div>
</div>


