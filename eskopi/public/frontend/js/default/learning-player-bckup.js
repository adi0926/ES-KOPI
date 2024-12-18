"use strict";
const csrf_token = $("meta[name='csrf-token']").attr("content");

const placeholder = `<div class="player-placeholder">
<div class="preloader-two player">
    <div class="loader-icon-two player"><img src="${preloader_path}" alt="Preloader"></div>
</div>
</div>`;

function extractGoogleDriveVideoId(url) {
    var googleDriveRegex =
        /(?:https?:\/\/)?(?:www\.)?(?:drive\.google\.com\/(?:uc\?id=|file\/d\/|open\?id=)|youtu\.be\/)([\w-]{25,})[?=&#]*/;

    var match = url.match(googleDriveRegex);

    if (match && match[1]) {
        return match[1];
    } else {
        return null;
    }
}

function showSidebar() {
    $(".wsus__course_sidebar").addClass("show");
}

function hideSidebar() {
    $(".wsus__course_sidebar").removeClass("show");
}

$(document).ready(function () {
    $(document).on('contextmenu', function(e) {
        e.preventDefault();
        return false;
    });
    $(document).on('keydown', function(e) {
        if (e.which === 123 ||
            (e.ctrlKey && e.shiftKey && (e.which === 'I'.charCodeAt(0) || e.which === 'J'.charCodeAt(0))) ||
            (e.ctrlKey && e.which === 'U'.charCodeAt(0))) {
            e.preventDefault();
            return false;
        }
    });

    //image popup init
    $(document).on("click", ".image-popup", function () {
        $.magnificPopup.open({
            items: {
                src: $(this).attr("src"),
            },
            type: "image",
        });
    });
    document.addEventListener("focusin", (e) => {
        if (
            e.target.closest(
                ".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root"
            ) !== null
        ) {
            e.stopImmediatePropagation();
        }
    });

    $(".form-check").on("click", function () {
        $(".form-check").removeClass("item-active");
        $(this).addClass("item-active");
    });

    $(".lesson-item").on("click", function () {
        hideSidebar();
    
        var tipekonten = $(this).attr("data-type");
        var id_konten = $(this).attr("data-id-konten");
        let playerHtml;
    
        if (tipekonten == "open") {
            let diklatName = document.getElementById('diklat-data').dataset.diklatName;
            playerHtml = `
                <div class="resource-file">
                    <div class="file-info">
                        <div class="text-center">
                            <img src="/uploads/website-images/courserwelcome.png" alt="" style="width: 350px; height: auto;">
                            <h6 class="mt-2">Selamat Datang</h6>
                            <p>Selamat datang di diklat ${diklatName}</p>
                            <div class="button-container" style="margin-top: 20px;">
                                <button class="btn btn-primary" id="mulai-diklat" data-idkonten="${id_konten}">Mulai Diklat</button>
                            </div>
                        </div>
                    </div>
                </div>`;
        } else if (tipekonten == "video") {
            var materiUrl = $(this).attr("data-url");
            playerHtml = `
                <iframe class="iframe-video" 
                    src="https://www.youtube.com/embed/${materiUrl}"
                    width="640" height="480" 
                    allow="autoplay" frameborder="0" 
                    autoplay allowfullscreen>
                </iframe>`;
        } else if (tipekonten == "pdf") {
            playerHtml = `
                <div class="resource-file">
                    <div class="file-info">
                        <div class="text-center">
                            <img src="/uploads/website-images/resource-file.png" alt="">
                            <h6 class="mt-2">Materi Diklat PTSP</h6>
                            <p>Unduh berkas materi diklat PTSP (materidiklatptsp.pdf)</p>
                            <a href="#" class="btn btn-primary">Unduh Materi</a>
                        </div>
                    </div>
                </div>`;
        } else if (tipekonten == "soal") {

            var tipeSoal = $(this).attr("data-tipe-soal");
            var statusPengerjaan = $(this).attr("data-status");
            var jumlahSoal = $(this).attr("data-jumlahsoal");
            var durasiSoal = $(this).attr("data-durasi");

            if(tipeSoal == "pretest"){
                if(statusPengerjaan == "0"){
                    playerHtml = `
                    <div class="resource-file">
                        <div class="file-info">
                            <div class="text-center">
                                <img src="/uploads/website-images/test.png" alt="">
                                <h6 class="mt-2">Pre Test</h6>
                                <p>Test ini dikerjakan sebelum memulai mempelajari materi diklat.</p>
                
                                <p>Jumlah soal : ${jumlahSoal} Soal</p>
                                <p>Durasi Pengerjaan : ${durasiSoal} Menit</p>
                                <a href="#" class="btn btn-primary" id="start-pretest" data-idkonten="${id_konten}" data-durasipengerjaan="${durasiSoal}">Mulai Pre Test</a>
                            </div>
                        </div>
                    </div>`;
                } else {
                    $.ajax({
                        url: `/peserta/getNilai/${id_konten}`,
                        method: 'GET',
                        success: function (response) {
                            const correctAnswers = response.correct_answers;
                            const wrongAnswers = response.wrong_answers;
                            const score = response.score;

                            let noteText = "";
                            if (score < 60) {
                                noteText = "Cobalah lagi! Kamu bisa lebih baik setelah mempelajari lebih dalam diklat ini.";
                            } else if (score >= 60 && score < 80) {
                                noteText = "Bagus! Tetapi masih ada ruang untuk perbaikan.";
                            } else if (score >= 80 && score < 99) {
                                noteText = "Nilai awalmu sangat baik. Sempurnakan pemahaman kamu dengan menyimak materi diklat ini.";
                            } else if (score == 100) {
                                noteText = "Luar biasa! Nilai sempurna, terus pertahankan!";
                            }

                            const playerHtml = `
                            <div class="resource-file">
                                <div class="file-info">
                                    <div class="text-center">
                                        <div class="test-completion">
                                            <div class="completion-header">
                                                <img src="/uploads/website-images/completetest.jpg" alt="Test Image" class="trophy-icon">
                                                <h2 class="completion-title">Selamat Kamu telah menyelesaikan Pre Test Diklat ini</h2>
                                            </div>
                                            <div class="completion-details">
                                                <div class="details-row">
                                                    <span><strong>Benar :</strong> ${correctAnswers}</span>
                                                    <span><strong>Salah :</strong> ${wrongAnswers}</span>
                                                </div>
                                                <div class="details-row">
                                                    <span><strong>Nilai Akhir :</strong> <span class="score" style="color: ${getScoreColor(score)}">${score}</span></span>
                                                </div>
                                            </div>
                                            <div class="note">
                                                <p>${noteText}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;

                            $(".video-payer").html(playerHtml);
                        },
                        error: function () {
                            Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan jawaban.', 'error');
                        }
                    });
                }
            } else if(tipeSoal == "posttest"){
                playerHtml = `
                <div class="resource-file">
                    <div class="file-info">
                        <div class="text-center">
                            <img src="/uploads/website-images/test.png" alt="">
                            <h6 class="mt-2">Post Test</h6>
                            <p>Test ini dikerjakan setelah selesai mempelajari materi diklat.</p>
            
                            <p>Jumlah soal : ${jumlahSoal} Soal</p>
                            <p>Durasi Pengerjaan : ${durasiSoal} Menit</p>
                            <a href="#" class="btn btn-primary" id="start-pretest">Mulai Post Test</a>
                        </div>
                    </div>
                </div>`;
            } else {
                playerHtml = `
                <div class="resource-file">
                    <div class="file-info">
                        <div class="text-center">
                            <h6>No Content Available</h6>
                        </div>
                    </div>
                </div>`;
            }
            
        } else {
            playerHtml = `
                <div class="resource-file">
                    <div class="file-info">
                        <div class="text-center">
                            <h6>No Content Available</h6>
                        </div>
                    </div>
                </div>`;
        }
        
    
        $(".video-payer").html(playerHtml);
    
        $(".about-lecture").html(`Deskripsi Konten ${id_konten}`);

    });

    
    let timerInterval;

    $(document).on("click", "#mulai-diklat", function (e) {
        e.preventDefault();

        const id_konten = $(this).data('idkonten');

        $.ajax({
            url: "/peserta/start",
            method: "POST",
            data: JSON.stringify({ id_konten: id_konten }),
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                location.reload();
            },
            error: function () {
                Swal.fire('Gagal', 'Terjadi kesalahan saat memulai Diklat.', 'error');
            }
        });

    });

    // mulai pre test
    $(document).on("click", "#start-pretest", function (e) {

        e.preventDefault();

        const id_konten = $(this).data('idkonten');
        const durasiPengerjaan = $(this).data('durasipengerjaan');
        
        // get soal
        $.ajax({
            url: `/peserta/getsoal/${id_konten}`,
            method: 'GET',
            success: function (data) {
                let currentQuestionIndex = 0;
                const totalQuestions = data.length;
                const answers = new Array(totalQuestions).fill(null);
                const visited = new Array(totalQuestions).fill(false);
    
                function renderQuestion(index) {
                    visited[currentQuestionIndex] = true;
                    const question = data[index];
                    const optionsHtml = `
                        <label><input type="radio" name="q${index}" value="a"> ${question.pilihan_a}</label>
                        <label><input type="radio" name="q${index}" value="b"> ${question.pilihan_b}</label>
                        <label><input type="radio" name="q${index}" value="c"> ${question.pilihan_c}</label>
                        <label><input type="radio" name="q${index}" value="d"> ${question.pilihan_d}</label>
                        <label><input type="radio" name="q${index}" value="e"> ${question.pilihan_e}</label>
                    `;
    
                    $(".test-question-container").html(`
                        <div class="test-question">
                            <div class="test-question-text">
                                <p>${index + 1}. ${question.soal}</p>
                            </div>
                            <div class="test-options">
                                ${optionsHtml}
                            </div>
                        </div>
                    `);
                        
                    if (answers[index]) {
                        $(`input[name="q${index}"][value="${answers[index]}"]`).prop("checked", true);
                    }
                    
                }
    
                function renderQuestionNumbers() {
                    const questionNumberButtons = data
                        .map((q, index) => {
                            let btnClass = "test-gray";

                            if (index === currentQuestionIndex) {
                                btnClass = "test-blue";
                            } else if (answers[index] !== null) {
                                btnClass = "test-green";
                            } else if (visited[index]) {
                                btnClass = "test-red";
                            } else {
                                btnClass = "test-gray";
                            }
    
                            return `<button class="test-q-btn ${btnClass}" data-question-index="${index}">${index + 1}</button>`;
                        })
                        .join("");
    
                    $(".test-question-number").html(questionNumberButtons);
                }
    
                const preTestContent = `
                    <div class="test">
                        <div class="test-header">
                            <h1>Pre Test</h1>
                        </div>
                        <div class="test-content">
                            <div class="test-question-container"></div>
                        </div>

                        <div class="test-timer" id="timer">
                            ${durasiPengerjaan} : 00
                        </div>
    
                        <div class="test-question-number-container">
                            <div class="test-question-number"></div>
                        </div>
    
                        <div class="test-footer">
                            <div class="test-navigation">
                                <button class="previous-button" disabled>Sebelumnya</button>
                                <button class="next-button">Selanjutnya</button>
                                <button class="end-test-button" style="display: none;">Akhiri Test</button>
                            </div>
                        </div>
                    </div>
                `;
    
                $(".video-payer").html(preTestContent);


                // render pertanyaan dan logic untuk pindah pindah soal
                renderQuestion(currentQuestionIndex);
                renderQuestionNumbers();

                $(document).on("click", ".test-q-btn", function () {
                    currentQuestionIndex = parseInt($(this).data("question-index"));
                    renderQuestion(currentQuestionIndex);
                    updateNavigationButtons();
                    renderQuestionNumbers();
                });
    
                $(document).on("click", ".previous-button", function () {
                    if (currentQuestionIndex > 0) {
                        currentQuestionIndex--;
                        renderQuestion(currentQuestionIndex);
                        updateNavigationButtons();
                        renderQuestionNumbers();
                    }
                });
    
                $(document).on("click", ".next-button", function () {
                    if (currentQuestionIndex < totalQuestions - 1) {
                        currentQuestionIndex++;
                        renderQuestion(currentQuestionIndex);
                        updateNavigationButtons();
                        renderQuestionNumbers();
                    }
                });

                $(document).on("change", `.test-options input[type="radio"]`, function () {
                    const selectedValue = $(this).val();
                    answers[currentQuestionIndex] = selectedValue;
                    renderQuestionNumbers();
                });
    
                function updateNavigationButtons() {
                    $(".previous-button").prop("disabled", currentQuestionIndex === 0);
                    
                    const isLastQuestion = currentQuestionIndex === totalQuestions - 1;
                    $(".next-button").prop("disabled", isLastQuestion);
                    if (isLastQuestion) {
                        $(".next-button").hide();
                        $(".end-test-button").show();
                    } else {
                        $(".next-button").show();
                        $(".end-test-button").hide();
                    }
                }

                $(".end-test-button").on("click", function() {
                    Swal.fire({
                        title: 'Akhiri Pre Test',
                        text: 'Apakah anda yakin mengakhiri Pre Test ? Anda masih memiliki waktu, pastikan jawaban sudah terisi sepenuhnya.',
                        imageUrl: "/uploads/website-images/mark.png",
                        imageWidth: 150,
                        imageHeight: 150,
                        showCancelButton: true,
                        confirmButtonText: 'Konfirmasi',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#263D93',
                        cancelButtonColor: '#d33',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            clearInterval(timerInterval);
                            const answersPayload = answers
                                .map((jawaban, index) => ({
                                    id_core_soal_materi: data[index].id,
                                    jawaban: jawaban
                                }))

                            $.ajax({
                                url: "/peserta/saveJawaban",
                                method: "POST",
                                data: JSON.stringify(answersPayload),
                                contentType: "application/json",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (response) {
                                    const correctAnswers = response.correct_answers;
                                    const wrongAnswers = response.wrong_answers;
                                    const score = response.score;

                                    let noteText = "";
                                    if (score < 60) {
                                        noteText = "Cobalah lagi! Kamu bisa lebih baik setelah mempelajari lebih dalam diklat ini.";
                                    } else if (score >= 60 && score < 80) {
                                        noteText = "Bagus! Tetapi masih ada ruang untuk perbaikan.";
                                    } else if (score >= 80 && score < 99) {
                                        noteText = "Nilai awalmu sangat baik. Sempurnakan pemahaman kamu dengan menyimak materi diklat ini.";
                                    } else if (score == 100) {
                                        noteText = "Luar biasa! Nilai sempurna, terus pertahankan!";
                                    }

                                    const playerHtml = `
                                    <div class="resource-file">
                                        <div class="file-info">
                                            <div class="text-center">
                                                <div class="test-completion">
                                                    <div class="completion-header">
                                                        <img src="/uploads/website-images/completetest.jpg" alt="Test Image" class="trophy-icon">
                                                        <h2 class="completion-title">Selamat Kamu telah menyelesaikan Pre Test Diklat ini</h2>
                                                    </div>
                                                    <div class="completion-details">
                                                        <div class="details-row">
                                                            <span><strong>Benar :</strong> ${correctAnswers}</span>
                                                            <span><strong>Salah :</strong> ${wrongAnswers}</span>
                                                        </div>
                                                        <div class="details-row">
                                                            <span><strong>Nilai Akhir :</strong> <span class="score" style="color: ${getScoreColor(score)}">${score}</span></span>
                                                        </div>
                                                    </div>
                                                    <div class="note">
                                                        <p>${noteText}</p>
                                                    </div>

                                                    <div class="button-container" style="margin-top: 20px;">
                                                        <button class="btn btn-primary" id="reload-page-after-test">Selanjutnya</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `;

                                    $(".video-payer").html(playerHtml);
                                    
                                    $("#reload-page-after-test").on("click", function () {
                                        location.reload();
                                    });
                                },
                                error: function () {
                                    Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan jawaban.', 'error');
                                }
                            });
                        } else if (result.isDismissed) {
                            console.log('Cancelled');
                        }
                    });
                });

            },

            error: function (error) {
                console.error("Error fetching questions:", error);
            },
        });

        // mulai timer
        startTimer(durasiPengerjaan);
    });

    function getScoreColor(score) {
        if (score >= 80) {
            return 'green';
        } else if (score >= 65) {
            return '#FFB500';
        } else {
            return 'red';
        }
    }

    // timer pre test
    function startTimer(time) {
        let timeLeft = time * 60;
        clearInterval(timerInterval);
        timerInterval = setInterval(() => {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            $("#timer").text(`${minutes.toString().padStart(2, "0")} : ${seconds.toString().padStart(2, "0")}`);
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                popupTestLimit();
            }
            timeLeft--;
        }, 1000);
    }

    function popupTestLimit() {
        Swal.fire({
            title: 'Waktu Habis',
            text: 'Waktu pengerjaan test telah selesai, Jawaban akan disimpan.',
            imageUrl: "/uploads/website-images/mark.png",
            imageWidth: 150,
            imageHeight: 150,
            showCancelButton: false,
            confirmButtonText: 'Konfirmasi',
            confirmButtonColor: '#263D93',
            reverseButtons: true,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('Confirmed');
            }
        });
    }


    $(".lesson-item-xxxx").on("click", function () {
        
        hideSidebar();

        var lessonId = $(this).attr("data-lesson-id");
        var chapterId = $(this).attr("data-chapter-id");
        var courseId = $(this).attr("data-course-id");
        var type = $(this).attr("data-type");

        $.ajax({
            method: "POST",
            url: base_url + "/student/learning/get-file-info",
            data: {
                _token: csrf_token,
                lessonId: lessonId,
                chapterId: chapterId,
                courseId: courseId,
                type: type,
            },
            beforeSend: function () {
                $(".video-payer").html(placeholder);
            },
            success: function (data) {
                // set lesson id on meta
                $("meta[name='lesson-id']").attr("content", data.file_info.id);
                let playerHtml;
                const { file_info } = data;

                if (file_info.file_type != 'video' && file_info.storage != 'iframe' && (file_info.type == 'lesson' || file_info.type == 'aws' || file_info.type == 'wasabi' || file_info.type == 'live')) {
                    if (file_info.storage == 'upload') {
                        playerHtml = `<div class="resource-file">
                        <div class="file-info">
                            <div class="text-center">
                                <img src="/uploads/website-images/resource-file.png" alt="">
                                <h6>${resource_text}</h6>
                                <p>${file_type_text}: ${file_info.file_type}</p>
                                <p>${download_des_text}</p>
                                <form action="/student/learning/resource-download/${file_info.id}" method="get" class="download-form">
                                    <button type="submit" class="btn btn-primary">${download_btn_text}</button>
                                </form>
                            </div>
                        </div>
                    </div>`
                    }else if(file_info.storage == 'live'){
                       let btnHtml = '';
                       if (file_info.is_live_now == 'started') {
                            btnHtml = `<h6>${le_hea}</h6>`;
                            btnHtml += `<p>${le_des} <b class="text-highlight">${file_info.end_time}</b></p>`;
                            if ((file_info.live.type === 'jitsi' && file_info.course.instructor.jitsi_credential) || (file_info.live.type === 'zoom' && file_info.course.instructor.zoom_credential)) {
                                btnHtml += `<a href="${base_url + '/student/learning/' + file_info.course.slug + '/' + file_info.id}" class="btn btn-two me-2">${open_w_txt}</a>`;
                            }else{
                                btnHtml += `<p>${file_info.live.type === 'zoom' ? 'Zoom' : 'Jitsi'} ${cre_mi_txt}</p>`;
                            }
                            if(file_info.live.type === 'zoom' && file_info.live.join_url){
                                btnHtml += `<a target="_blank" href="${file_info.live.join_url}" class="btn">Zoom app</a>`;
                            }
                        }else if(file_info.is_live_now == 'ended'){
                            btnHtml = `<h6>${le_fi_he}</h6>`;
                            btnHtml += `<p>${le_fi_des}</p>`;
                        } else {
                            btnHtml = `<h6>${le_wi_he}</h6>`;
                            btnHtml += `<p>${le_wi_des} <b class="text-highlight">${file_info.start_time}</b></p>`;
                        }

                        playerHtml = `<div class="resource-file">
                        <div class="file-info">
                            <div class="text-center">
                            <img src="${base_url + '/frontend/img/online-learning.png'}" alt="">
                                ${btnHtml}
                            </div>
                        </div>
                    </div>`
                    } else {
                        playerHtml = `<div class="resource-file">
                        <div class="file-info">
                            <div class="text-center">
                                <img src="/uploads/website-images/resource-file.png" alt="">
                                <h6>${resource_text}</h6>
                                <p>${file_type_text}: ${file_info.file_type}</p>
                                <p>${open_des_txt}</p>
                                <a href="${file_info.file_path}" target="_blank" class="btn btn-primary">${open_txt}</a>
                            </div>
                        </div>
                    </div>`
                    }
                } else if (file_info.storage == 'youtube' && (file_info.type == 'lesson' || file_info.type == 'live')) {
                    playerHtml = `<video id="vid1" class="video-js vjs-default-skin" controls autoplay width="640" height="264"
                        data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "${file_info.file_path}"}] }'>
                        </video>`;
                } else if (file_info.storage == 'vimeo' && (file_info.type == 'lesson' || file_info.type == 'live')) {
                    playerHtml = `<video id="vid1" class="video-js vjs-default-skin" controls autoplay width="640" height="264"
                        data-setup='{ "techOrder": ["vimeo"], "sources": [{ "type": "video/vimeo", "src": "${file_info.file_path}"}] }'>
                        </video>`;
                } else if ((file_info.storage == 'upload' || file_info.storage == 'external_link' || file_info.storage == 'aws' || file_info.storage == 'wasabi') && (file_info.type == 'lesson' || file_info.type == 'live')) {
                    playerHtml = `<video src="${file_info.file_path}" type="video/mp4" id="vid1" class="video-js vjs-default-skin" controls autoplay width="640" height="264"
                        data-setup='{}] }'>
                        </video>`;
                } else if (file_info.storage == 'google_drive' && file_info.type == 'lesson') {
                    playerHtml = `<iframe class="iframe-video" src="https://drive.google.com/file/d/${extractGoogleDriveVideoId(file_info.file_path)}/preview" width="640" height="680" allow="autoplay" frameborder="0" autoplay allowfullscreen></iframe>`
                } else if (file_info.type == 'document' && file_info.file_type != 'txt') {
                    playerHtml = data.view;
                } else if (file_info.storage == 'iframe' || file_info.type == 'document') {
                    playerHtml = `<iframe class="iframe-video" src="${file_info.type == 'document' ? base_url + file_info.file_path : file_info.file_path}" frameborder="0" allowfullscreen></iframe>`
                } else if (file_info.type == 'quiz') {
                    playerHtml = `<div class="resource-file">
                    <div class="file-info">
                        <div class="text-center">
                            <img src="/uploads/website-images/quiz.png" alt="">
                            <h6 class="mt-2">${file_info.title}</h6>
                            <p>${quiz_st_des_txt}</p>
                            <a href="/student/learning/quiz/${file_info.id}" class="btn btn-primary">${quiz_st_txt}</a>
                        </div>
                    </div>
                </div>`
                }

                // Resetting any existing player instance
                if (videojs.getPlayers()["vid1"]) {
                    videojs.getPlayers()["vid1"].dispose();
                }

                $(".video-payer").html(playerHtml);

                // Initializing the player
                if (document.getElementById("vid1")) {
                    videojs("vid1").ready(function () {
                        this.play();
                    });
                }

                // set lecture description
                $(".about-lecture").html(
                    file_info.description || no_des_txt
                );

                // load qna's
                fetchQuestions(courseId, lessonId, 1, true);
            },
            error: function (xhr, status, error) { },
        });
    });

    $(".lesson-completed-checkbox").on("click", function () {
        let lessonId = $(this).attr("data-lesson-id");
        let type = $(this).attr("data-type");
        let checked = $(this).is(":checked") ? 1 : 0;
        $.ajax({
            method: "POST",
            url: base_url + "/student/learning/make-lesson-complete",
            data: {
                _token: csrf_token,
                lessonId: lessonId,
                status: checked,
                type: type,
            },
            success: function (data) {
                if (data.status == "success") {
                    toastr.success(data.message);
                } else if (data.status == "error") {
                    toastr.error(data.message);
                }
            },
            error: function (xhr, status, error) {
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, value) {
                    toastr.error(value);
                });
            },
        });
    });

    // Course video button for small devices
    $(".wsus__course_header_btn").on("click", function () {
        $(".wsus__course_sidebar").addClass("show");
    });

    $(".wsus__course_sidebar_btn").on("click", function () {
        $(".wsus__course_sidebar").removeClass("show");
    });
});
