/**
 * PRESENTATION SLIDESHOW CONTROLLER
 * Designed by Antigravity for student Dinh Phuong Ly (TLU)
 */

document.addEventListener('DOMContentLoaded', () => {
    // ==========================================================================
    // STATE VARIABLES
    // ==========================================================================
    let currentSlide = 0;
    const totalSlides = 12; // 1 Intro slide + 11 Content slides
    let autoplayInterval = null;
    let isAutoplayActive = false;
    let autoplayDuration = 8000; // 8 seconds per slide in autoplay

    // Touch swipe support
    let touchStartX = 0;
    let touchEndX = 0;

    // Teleprompter state
    let noteFontSize = 16; // default 16px for Times Roman readability
    let isAutoscrollActive = false;
    let autoscrollInterval = null;

    // ==========================================================================
    // SPEAKER NOTES CONTENT DATA
    // ==========================================================================
    const speakerNotes = [
        {
            title: "Giới thiệu - Đinh Phương Ly",
            text: `<p><strong>[GIỚI THIỆU BẢN THÂN]</strong> Kính thưa Ban giám khảo, quý vị đại biểu cùng toàn thể hội thi!</p>
                   <p>Em tên là <strong>Đinh Phương Ly</strong>, sinh viên Khoa Công nghệ thông tin, Trường Đại học Thủy lợi.</p>
                   <p>Đến với hội thi hùng biện hôm nay, em rất vinh dự được đại diện Khoa và Nhà trường trình bày bài thuyết trình về <strong>Chủ đề 3: Làm rõ vị thế, vai trò của văn hóa đối với sự phát triển bền vững của đất nước</strong> dựa trên tinh thần Nghị quyết 80-NQ/TW ban hành ngày 07/01/2026 của Bộ Chính trị. Từ đó, em xin đề xuất các giải pháp trọng tâm nhằm phát huy vai trò chủ thể của Nhân dân và chuyển hóa các giá trị văn hóa thành động lực thúc đẩy kinh tế - xã hội trong kỷ nguyên mới.</p>`,
            note: "Chào ban giám khảo với thái độ lịch sự, đứng thẳng lưng, mỉm cười tự tin, nói giọng rõ ràng, truyền cảm."
        },
        {
            title: "Mở đầu - Định danh Việt Nam",
            text: `<p><strong>[MỞ ĐẦU]</strong> Kính thưa quý vị!</p>
                   <p>Giữa thế giới hơn 8 tỷ người đang chuyển động từng giây với trí tuệ nhân tạo, dữ liệu lớn và công nghệ số, có bao giờ chúng ta tự đặt câu hỏi cho chính mình: <em>“Điều gì định danh chúng ta vẫn là người Việt Nam?”</em></p>
                   <p>Dù đi bất cứ nơi đâu, bản sắc văn hóa chính là "căn cước công dân" để nhận diện tâm hồn Việt Nam trên bản đồ thế giới.</p>`,
            note: "Nói dõng dạc, nhấn mạnh con số 8 tỷ người. Tạo khoảng nghỉ ngắn khi đặt câu hỏi để thu hút sự tò mò của người nghe."
        },
        {
            title: "Tư duy mã nguồn - Phần cứng & Hệ điều hành",
            text: `<p>Là một sinh viên Công nghệ thông tin tại Đại học Thủy lợi, khi nhìn nhận xã hội dưới tư duy của một nhà phát triển hệ thống, tôi thấy:</p>
                   <p>Nếu kinh tế là <strong>“phần cứng” (Hardware)</strong> tạo nên sức mạnh vật chất nền tảng, thì văn hóa chính là <strong>“hệ điều hành” (OS)</strong> quyết định cách thức vận hành, khí chất và tâm hồn của cả dân tộc.</p>`,
            note: "Nhấn mạnh sự so sánh ví von Hardware & OS. Có thể hướng tay về phía bảng Console trên màn hình để minh họa."
        },
        {
            title: "Chân lý Nguyễn Phú Trọng & Nghị quyết 80",
            text: `<p>Năm 2021, nguyên Tổng Bí thư Nguyễn Phú Trọng đã khẳng định một chân lý trường tồn: <strong>“Văn hóa còn thì dân tộc còn, văn hóa mất thì dân tộc mất.”</strong></p>
                   <p>Và để cụ thể hóa chân lý ấy, Nghị quyết 80 ban hành ngày 07/01/2026 của Bộ Chính trị một lần nữa khẳng định đanh thép: Văn hóa là nền tảng tinh thần, sức mạnh nội sinh và động lực trực tiếp cho phát triển bền vững quốc gia.</p>`,
            note: "Nhấn mạnh mốc thời gian: Năm 2021 và ngày 07/01/2026. Đọc câu trích dẫn của Bác Trọng bằng giọng trang nghiêm, tự hào."
        },
        {
            title: "Định nghĩa văn hóa & Giá trị truyền thống",
            text: `<p>Kính thưa quý vị! Văn hóa không phải điều gì trừu tượng. Văn hóa chính là những giá trị thực tế và gần gũi nhất bên cạnh chúng ta.</p>
                   <p>Văn hóa là <strong>tiếng Việt</strong> thân thương ta nói hàng ngày. Là <strong>lời ru ngọt ngào của mẹ</strong>, là <strong>lòng nhân ái</strong> và <strong>tinh thần đoàn kết</strong> keo sơn giúp dân tộc vượt qua muôn vàn giông bão lịch sử.</p>`,
            note: "Giọng nói trầm ấm, truyền cảm khi nhắc tới những hình ảnh gần gũi: Tiếng Việt, câu hát ru, lòng yêu nước."
        },
        {
            title: "Thách thức thế kỷ 21 - Nguy cơ xói mòn văn hóa",
            text: `<p>Tuy nhiên, trong thế giới phẳng, nguy cơ xói mòn văn hóa đang xuất hiện một cách tinh vi không tiếng súng.</p>
                   <p>Đó là sự <strong>phai nhạt nhận thức số</strong>, lối sống thực dụng và thờ ơ với lịch sử ở một bộ phận giới trẻ. Khi không gian mạng tràn ngập nội dung lệch chuẩn, nếu hệ miễn dịch tinh thần của chúng ta yếu đi, bản sắc dân tộc rất dễ bị hòa tan.</p>`,
            note: "Chuyển sang giọng trầm lắng, nét mặt trăn trở lo âu để lột tả thách thức thời đại số."
        },
        {
            title: "Thế hệ trẻ & Sự thức tỉnh",
            text: `<p>Nhưng chúng ta tin tưởng rằng, thế hệ trẻ Việt Nam không hề quay lưng với truyền thống. Ngược lại, họ đang tiếp cận văn hóa bằng ngôn ngữ hiện đại.</p>
                   <p>Ta tự hào nhìn thấy hàng triệu người trẻ xúc động hướng về Tổ quốc trong các sự kiện quốc gia lớn như Đại lễ A80, hát vang khúc ca tự hào tại các concert âm nhạc, hay lặng đi đầy xúc động trước vở kịch cách mạng “Mưa đỏ”. Bản sắc dân tộc chưa bao giờ nguội tắt.</p>`,
            note: "Nói bằng giọng xúc động, sau đó hào hùng khi lấy dẫn chứng về các sự kiện thanh niên yêu nước."
        },
        {
            title: "Giải pháp 1: Đại sứ văn hóa số",
            text: `<p>Để phát huy vai trò chủ thể của Nhân dân, giải pháp đầu tiên là xây dựng lực lượng <strong>“Đại sứ văn hóa số”</strong>.</p>
                   <p>Mỗi người dân, đặc biệt là học sinh sinh viên công nghệ, hãy chủ động sáng tạo nội dung, đưa lịch sử, ẩm thực, phong tục Việt Nam lên không gian số. Chiến dịch “Tự hào người Việt Nam” trực tuyến sẽ tạo làn sóng lan tỏa mạnh mẽ.</p>`,
            note: "Giọng thuyết phục, mắt hướng tới khán giả để kêu gọi hành động chung tay làm Đại sứ văn hóa số."
        },
        {
            title: "Giải pháp 2: Kinh tế hóa văn hóa & Nghị quyết 80",
            text: `<p>Thứ hai, chúng ta phải chuyển hóa giá trị văn hóa thành động lực kinh tế trực tiếp.</p>
                   <p>Phát triển mạnh mẽ các ngành <strong>công nghiệp văn hóa số</strong>: Ứng dụng VR/AR số hóa di sản du lịch, hỗ trợ các dự án startup từ tài nguyên bản địa và đưa các mặt hàng thủ công truyền thống xuất khẩu qua các sàn thương mại điện tử toàn cầu.</p>`,
            note: "Phong thái đĩnh đạc, cử chỉ tay dứt khoát khi nêu các luận điểm kinh tế vững vàng."
        },
        {
            title: "Giải pháp 3: Hệ miễn dịch văn hóa số",
            text: `<p>Thứ ba, thiết lập <strong>“hệ miễn dịch văn hóa”</strong> trên không gian mạng.</p>
                   <p>Tăng cường giáo dục chính trị số, trang bị bộ lọc nhận thức giúp người trẻ chủ động đề kháng trước văn hóa độc hại ngoại lai, kiên quyết đấu tranh phản bác và tẩy chay thông tin xấu độc để làm sạch môi trường mạng.</p>`,
            note: "Gằn giọng kiên quyết ở cụm từ 'đề kháng' và 'tẩy chay thông tin xấu độc'."
        },
        {
            title: "Kết luận - Mã nguồn tự cường dân tộc",
            text: `<p>Kính thưa toàn thể hội thi!</p>
                   <p>Một dân tộc trường tồn khi và chỉ khi nền văn hóa của dân tộc đó được giữ gìn và tiếp nối.</p>
                   <p>Là sinh viên Công nghệ thông tin trường Đại học Thủy lợi, chúng em cam kết không chỉ viết nên những dòng code máy móc, mà sẽ viết nên <strong>"mã nguồn" của lòng tự cường dân tộc</strong> - nơi công nghệ và văn hóa Việt Nam hòa quyện cùng đưa đất nước vươn tầm trong kỷ nguyên mới. Xin trân trọng cảm ơn!</p>`,
            note: "Đoạn kết hào hùng, vang vọng, giơ tay thể hiện khí thế tuổi trẻ quyết tâm. Cúi chào trân trọng sau khi dứt lời."
        },
        {
            title: "Lời kết & Cảm ơn",
            text: `<p><strong>[LỜI CẢM ƠN VÀ CHÚC SỨC KHỎE]</strong> Kính thưa Ban giám khảo, quý vị đại biểu cùng toàn thể hội thi!</p>
                   <p>Bài thuyết trình của em đến đây là kết thúc. Em xin gửi lời cảm ơn chân thành và sâu sắc nhất tới Ban giám khảo, quý vị đại biểu cùng toàn thể hội thi đã chú ý lắng nghe.</p>
                   <p>Kính chúc hội thi thành công tốt đẹp! Chúc Ban giám khảo và toàn thể quý vị đại biểu dồi dào sức khỏe, hạnh phúc và thành công! Em xin trân trọng cảm ơn!</p>`,
            note: "Cúi đầu chào trang nghiêm, giữ nụ cười tươi tắn và chân thành để tạo thiện cảm cuối cùng."
        }
    ];

    // ==========================================================================
    // DOM ELEMENTS SELECTORS
    // ==========================================================================
    const slides = document.querySelectorAll('.slide-content');
    const imageWrappers = document.querySelectorAll('.image-wrapper');
    const indicatorsContainer = document.getElementById('indicators');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const progressBar = document.getElementById('progress-bar');

    const playPauseBtn = document.getElementById('play-pause-btn');
    const themeToggleBtn = document.getElementById('theme-toggle');
    const fullscreenToggleBtn = document.getElementById('fullscreen-toggle');
    const speakerModeToggleBtn = document.getElementById('speaker-mode-toggle');

    // Notes panel
    const speakerNotesPanel = document.getElementById('speaker-notes-panel');
    const notesTextContainer = document.getElementById('speaker-notes-text');
    const notesSlideNum = document.getElementById('notes-slide-num');
    const closeNotesBtn = document.getElementById('close-notes-btn');
    const fontDecreaseBtn = document.getElementById('font-decrease');
    const fontIncreaseBtn = document.getElementById('font-increase');
    const autoscrollToggleBtn = document.getElementById('autoscroll-toggle');

    // Overview modal
    const overviewBtn = document.getElementById('overview-btn');
    const overviewModal = document.getElementById('overview-modal');
    const closeOverviewModalBtn = document.getElementById('close-overview-modal');
    const overviewGrid = document.getElementById('overview-grid');

    // Interactive console on Slide 2
    const runConsoleBtn = document.getElementById('run-console-btn');

    // ==========================================================================
    // INITIALIZATION
    // ==========================================================================
    function init() {
        createIndicators();
        updateSlideDisplay();
        createParticles();
        setupEventListeners();
        setupTouchNavigation();
        initOverviewGrid();
    }

    // ==========================================================================
    // INDICATORS & DISPLAY UPDATES
    // ==========================================================================
    function createIndicators() {
        if (!indicatorsContainer) return;
        indicatorsContainer.innerHTML = '';
        for (let i = 0; i < totalSlides; i++) {
            const indicator = document.createElement('div');
            indicator.classList.add('indicator');
            if (i === 0) indicator.classList.add('active');
            indicator.addEventListener('click', () => {
                goToSlide(i);
            });
            indicatorsContainer.appendChild(indicator);
        }
    }

    function updateSlideDisplay() {
        // Toggle slide contents
        slides.forEach((slide, index) => {
            if (index === currentSlide) {
                slide.classList.add('active');
            } else {
                slide.classList.remove('active');
            }
        });

        // Toggle background images + re-trigger label animation
        imageWrappers.forEach((wrapper, index) => {
            if (index === currentSlide) {
                wrapper.classList.add('active');
                // Re-trigger label slide-up animation on each slide change
                const label = wrapper.querySelector('.image-label');
                if (label) {
                    label.style.animation = 'none';
                    label.offsetHeight; // force reflow
                    label.style.animation = '';
                }
            } else {
                wrapper.classList.remove('active');
            }
        });

        // Update indicators
        const indicators = document.querySelectorAll('.indicator');
        indicators.forEach((ind, index) => {
            if (index === currentSlide) {
                ind.classList.add('active');
            } else {
                ind.classList.remove('active');
            }
        });

        // Update progress bar
        if (progressBar) {
            const progressPercent = ((currentSlide + 1) / totalSlides) * 100;
            progressBar.style.width = `${progressPercent}%`;
        }

        // Update speaker notes
        updateSpeakerNotes();

        // Run number animation if Slide 1 (Định danh Việt Nam) is active
        if (currentSlide === 1) {
            animateNumberCounter();
        }
    }

    // ==========================================================================
    // SLIDE NAVIGATION LOGIC
    // ==========================================================================
    // ==========================================================================
    // CLICK-TO-REVEAL (PowerPoint-style)
    // ==========================================================================
    function resetReveals(slideEl) {
        if (!slideEl) return;
        const items = slideEl.querySelectorAll('.reveal-item');
        items.forEach(el => el.classList.remove('revealed'));
        updateRevealHint(slideEl);
        if (items.length > 0) {
            slideEl.classList.add('has-reveals');
            slideEl.classList.remove('all-revealed');
        }
    }

    function revealNext(slideEl) {
        if (!slideEl) return false;
        const items = slideEl.querySelectorAll('.reveal-item:not(.revealed)');
        if (items.length === 0) return false;
        items[0].classList.add('revealed');
        updateRevealHint(slideEl);
        if (slideEl.querySelectorAll('.reveal-item:not(.revealed)').length === 0) {
            slideEl.classList.add('all-revealed');
        }
        return true;
    }

    function updateRevealHint(slideEl) {
        let hint = slideEl.querySelector('.reveal-hint');
        const remaining = slideEl.querySelectorAll('.reveal-item:not(.revealed)').length;
        if (!hint && remaining > 0) {
            hint = document.createElement('span');
            hint.className = 'reveal-hint';
            hint.textContent = '';
            slideEl.appendChild(hint);
        }
        if (hint) {
            hint.classList.toggle('hidden', remaining === 0);
            hint.textContent = remaining > 0 ? `` : '';
        }
    }

    function goToSlide(index) {
        if (index >= 0 && index < totalSlides) {
            currentSlide = index;
            updateSlideDisplay();

            // Reset reveals for new slide
            const activeSlide = slides[currentSlide];
            resetReveals(activeSlide);

            // Auto scroll notes to top on slide change
            const panelContent = document.querySelector('.panel-content');
            if (panelContent) panelContent.scrollTop = 0;

            if (isAutoplayActive) {
                resetAutoplay();
            }
        }
    }

    function nextSlide() {
        // First try to reveal next item on current slide
        const activeSlide = slides[currentSlide];
        if (activeSlide && revealNext(activeSlide)) return;

        // All revealed (or no reveals) → advance slide
        if (currentSlide < totalSlides - 1) {
            goToSlide(currentSlide + 1);
        } else {
            if (isAutoplayActive) goToSlide(0);
        }
    }

    function prevSlide() {
        if (currentSlide > 0) {
            goToSlide(currentSlide - 1);
        }
    }

    // Keyboard controls mapping
    function handleKeyDown(e) {
        switch (e.key) {
            case 'ArrowRight':
            case 'PageDown':
            case ' ': // Spacebar
            case 'Enter':
                e.preventDefault();
                nextSlide();
                break;
            case 'ArrowLeft':
            case 'PageUp':
                e.preventDefault();
                prevSlide();
                break;
            case 'Home':
                e.preventDefault();
                goToSlide(0);
                break;
            case 'End':
                e.preventDefault();
                goToSlide(totalSlides - 1);
                break;
        }
    }

    // Touch Swipe support
    function setupTouchNavigation() {
        const presentation = document.querySelector('.presentation-container');
        if (!presentation) return;

        presentation.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, false);

        presentation.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, false);
    }

    function handleSwipe() {
        const swipeThreshold = 50;
        if (touchStartX - touchEndX > swipeThreshold) {
            // Swiped Left -> next
            nextSlide();
        } else if (touchEndX - touchStartX > swipeThreshold) {
            // Swiped Right -> prev
            prevSlide();
        }
    }

    // ==========================================================================
    // AUTOPLAY LOGIC
    // ==========================================================================
    function toggleAutoplay() {
        if (isAutoplayActive) {
            stopAutoplay();
        } else {
            startAutoplay();
        }
    }

    function startAutoplay() {
        isAutoplayActive = true;
        if (playPauseBtn) {
            playPauseBtn.innerHTML = '<i class="fa-solid fa-pause"></i> Tạm dừng';
            playPauseBtn.classList.add('active');
        }
        autoplayInterval = setInterval(nextSlide, autoplayDuration);
    }

    function stopAutoplay() {
        isAutoplayActive = false;
        if (playPauseBtn) {
            playPauseBtn.innerHTML = '<i class="fa-solid fa-play"></i> Tự động';
            playPauseBtn.classList.remove('active');
        }
        clearInterval(autoplayInterval);
    }

    function resetAutoplay() {
        clearInterval(autoplayInterval);
        autoplayInterval = setInterval(nextSlide, autoplayDuration);
    }

    // ==========================================================================
    // FLOATING PARTICLES GENERATOR
    // ==========================================================================
    function createParticles() {
        const container = document.getElementById('particles');
        if (!container) return;
        const particleCount = 15;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');

            // Random styling for variation
            const size = Math.random() * 15 + 4; // 4px to 19px
            const left = Math.random() * 100;
            const delay = Math.random() * 8;
            const duration = Math.random() * 6 + 6;

            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${left}%`;
            particle.style.animationDelay = `${delay}s`;
            particle.style.animationDuration = `${duration}s`;

            // Gold or Red gradient mix to match colors
            if (Math.random() > 0.5) {
                particle.style.background = 'radial-gradient(circle, rgba(255,222,0,0.6) 0%, rgba(255,222,0,0) 70%)';
            } else {
                particle.style.background = 'radial-gradient(circle, rgba(218,37,29,0.4) 0%, rgba(218,37,29,0) 70%)';
            }

            container.appendChild(particle);
        }
    }

    // ==========================================================================
    // COUNTER NUMBERS ANIMATION
    // ==========================================================================
    let hasAnimatedCounter = false;

    function animateNumberCounter() {
        const counterEl = document.querySelector('.counter');
        if (!counterEl || hasAnimatedCounter) return;

        hasAnimatedCounter = true; // Run only once
        const targetVal = parseInt(counterEl.getAttribute('data-target'));
        const duration = 2000;
        const frameRate = 60;
        const totalFrames = Math.round(duration / (1000 / frameRate));

        let currentFrame = 0;

        const timer = setInterval(() => {
            currentFrame++;

            const progress = currentFrame / totalFrames;
            const easeOutCubic = 1 - Math.pow(1 - progress, 3);

            const currentVal = Math.round(easeOutCubic * targetVal);

            counterEl.textContent = formatVietnameseNumber(currentVal) + '+';

            if (currentFrame >= totalFrames) {
                clearInterval(timer);
                counterEl.textContent = '8.000.000.000+';
            }
        }, 1000 / frameRate);
    }

    function formatVietnameseNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // ==========================================================================
    // SPEAKER TELEPROMPTER UTILITIES
    // ==========================================================================
    function updateSpeakerNotes() {
        const noteData = speakerNotes[currentSlide];
        if (!noteData) return;

        if (notesSlideNum) notesSlideNum.textContent = currentSlide; // 0-based for student index

        if (notesTextContainer) {
            notesTextContainer.innerHTML = `
                <div class="highlight-speech-note">
                    <i class="fa-solid fa-microphone-lines text-red"></i> <strong>Gợi ý diễn đạt:</strong> ${noteData.note}
                </div>
                ${noteData.text}
            `;
            notesTextContainer.style.fontSize = `${noteFontSize}px`;
        }
    }

    function toggleSpeakerMode() {
        if (!speakerNotesPanel) return;
        speakerNotesPanel.classList.toggle('open');

        if (speakerModeToggleBtn) {
            speakerModeToggleBtn.classList.toggle('active');
        }

        const isOpen = speakerNotesPanel.classList.contains('open');
        localStorage.setItem('speakerNotesOpen', isOpen);

        if (!isOpen) {
            stopAutoscroll();
        }
    }

    function changeFontSize(amount) {
        noteFontSize = Math.min(Math.max(noteFontSize + amount, 12), 26);
        if (notesTextContainer) {
            notesTextContainer.style.fontSize = `${noteFontSize}px`;
        }
        localStorage.setItem('notesFontSize', noteFontSize);
    }

    function toggleAutoscroll() {
        if (isAutoscrollActive) {
            stopAutoscroll();
        } else {
            startAutoscroll();
        }
    }

    function startAutoscroll() {
        isAutoscrollActive = true;
        if (autoscrollToggleBtn) autoscrollToggleBtn.classList.add('active');

        autoscrollInterval = setInterval(() => {
            const el = notesTextContainer;
            if (!el) return;
            const isAtBottom = el.scrollHeight - el.clientHeight <= el.scrollTop + 1;

            if (isAtBottom) {
                el.scrollTop = 0;
            } else {
                el.scrollTop += 1;
            }
        }, 45);
    }

    function stopAutoscroll() {
        isAutoscrollActive = false;
        if (autoscrollToggleBtn) autoscrollToggleBtn.classList.remove('active');
        clearInterval(autoscrollInterval);
    }

    // Load speaker notes preferences
    function loadSpeakerNotesPrefs() {
        if (!speakerNotesPanel) return;
        const savedOpen = localStorage.getItem('speakerNotesOpen');
        const savedSize = localStorage.getItem('notesFontSize');

        // Default to open for speech convenience
        if (savedOpen === 'false') {
            speakerNotesPanel.classList.remove('open');
            if (speakerModeToggleBtn) speakerModeToggleBtn.classList.remove('active');
        } else {
            speakerNotesPanel.classList.add('open');
            if (speakerModeToggleBtn) speakerModeToggleBtn.classList.add('active');
        }

        if (savedSize && notesTextContainer) {
            noteFontSize = parseInt(savedSize);
            notesTextContainer.style.fontSize = `${noteFontSize}px`;
        }
    }

    // ==========================================================================
    // INTERACTIVE CODE SIMULATOR (SLIDE 2)
    // ==========================================================================
    if (runConsoleBtn) {
        runConsoleBtn.addEventListener('click', () => {
            const body = document.querySelector('.console-body');
            if (!body || runConsoleBtn.classList.contains('running')) return;

            runConsoleBtn.classList.add('running');
            runConsoleBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Đang chạy...';

            const prevOutput = document.querySelectorAll('.console-output');
            prevOutput.forEach(el => el.remove());

            setTimeout(() => {
                appendConsoleLog(body, '>>> Initializing hardware modules... [OK]', 'rgba(255,255,255,0.5)');
            }, 600);

            setTimeout(() => {
                appendConsoleLog(body, '>>> Booting system core: "Vietnamese Culture OS" v8.0... [OK]', 'rgba(255,255,255,0.5)');
            }, 1200);

            setTimeout(() => {
                appendConsoleLog(body, '>>> Verifying integrity against Nghị quyết 80-NQ/TW...', '#ffde00');
            }, 1800);

            setTimeout(() => {
                appendConsoleLog(body, '>>> Sức mạnh nội sinh: 100% | Động lực phát triển: 100% ... [SECURE]', '#60a5fa');
            }, 2400);

            setTimeout(() => {
                appendConsoleLog(body, '>>> SUCCESS: "Việt Nam Hùng Cường" - Hệ thống vận hành hoàn hảo!', '#34d399');

                runConsoleBtn.classList.remove('running');
                runConsoleBtn.innerHTML = '<i class="fa-solid fa-check"></i> Chạy lại';
            }, 3000);
        });
    }

    function appendConsoleLog(parent, text, color) {
        const logLine = document.createElement('div');
        logLine.classList.add('console-output');
        logLine.style.color = color;
        logLine.textContent = text;
        parent.appendChild(logLine);

        const consoleContainer = document.querySelector('.interactive-console');
        if (consoleContainer) consoleContainer.scrollTop = consoleContainer.scrollHeight;
    }

    // ==========================================================================
    // OVERVIEW GRID & MODAL DIALOGS
    // ==========================================================================
    function initOverviewGrid() {
        if (!overviewGrid) return;
        overviewGrid.innerHTML = '';

        speakerNotes.forEach((slideData, idx) => {
            const card = document.createElement('div');
            card.classList.add('slide-card');
            if (idx === currentSlide) card.classList.add('active');

            const imgEl = imageWrappers[idx]?.querySelector('img');
            const imgPath = imgEl ? imgEl.getAttribute('src') : '';

            card.innerHTML = `
                <div class="card-preview">
                    <img src="${imgPath}" alt="${slideData.title}">
                    <span class="card-number">SLIDE ${idx}</span>
                </div>
                <div class="card-info">
                    <h5>${slideData.title}</h5>
                    <p>Nhấp vào để nhảy đến slide</p>
                </div>
            `;

            card.addEventListener('click', () => {
                goToSlide(idx);
                closeOverviewModal();
            });

            overviewGrid.appendChild(card);
        });
    }

    function openOverviewModal() {
        if (!overviewModal) return;
        const cards = document.querySelectorAll('.slide-card');
        cards.forEach((card, idx) => {
            if (idx === currentSlide) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });

        overviewModal.classList.add('open');
        stopAutoplay();
    }

    function closeOverviewModal() {
        if (overviewModal) overviewModal.classList.remove('open');
    }

    // Fullscreen toggling
    function toggleFullscreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().catch(err => {
                console.error(`Không thể kích hoạt chế độ toàn màn hình: ${err.message}`);
            });
            if (fullscreenToggleBtn) fullscreenToggleBtn.innerHTML = '<i class="fa-solid fa-compress"></i>';
        } else {
            document.exitFullscreen();
            if (fullscreenToggleBtn) fullscreenToggleBtn.innerHTML = '<i class="fa-solid fa-expand"></i>';
        }
    }

    // ==========================================================================
    // EVENT LISTENERS SETUP
    // ==========================================================================
    function setupEventListeners() {
        // Navigation Buttons (null-safe)
        if (prevBtn) prevBtn.addEventListener('click', prevSlide);
        if (nextBtn) nextBtn.addEventListener('click', nextSlide);

        // Keyboard mapping
        document.addEventListener('keydown', handleKeyDown);

        // Auto play (null-safe)
        if (playPauseBtn) playPauseBtn.addEventListener('click', toggleAutoplay);

        // Theme toggling (removed from header, null-safe)
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => {
                document.body.classList.toggle('light-theme');
                document.body.classList.toggle('dark-theme');
            });
        }

        // Fullscreen toggling (null-safe)
        if (fullscreenToggleBtn) fullscreenToggleBtn.addEventListener('click', toggleFullscreen);

        // Speaker notes controls (null-safe)
        if (speakerModeToggleBtn) speakerModeToggleBtn.addEventListener('click', toggleSpeakerMode);
        if (closeNotesBtn) closeNotesBtn.addEventListener('click', toggleSpeakerMode);
        if (fontIncreaseBtn) fontIncreaseBtn.addEventListener('click', () => changeFontSize(1));
        if (fontDecreaseBtn) fontDecreaseBtn.addEventListener('click', () => changeFontSize(-1));
        if (autoscrollToggleBtn) autoscrollToggleBtn.addEventListener('click', toggleAutoscroll);
        loadSpeakerNotesPrefs();

        // Overview grid modal (null-safe)
        if (overviewBtn) overviewBtn.addEventListener('click', openOverviewModal);
        if (closeOverviewModalBtn) closeOverviewModalBtn.addEventListener('click', closeOverviewModal);

        if (overviewModal) {
            overviewModal.addEventListener('click', (e) => {
                if (e.target === overviewModal) {
                    closeOverviewModal();
                }
            });
        }

        // Click on content stage = reveal next item or advance slide
        const contentStage = document.getElementById('content-stage');
        if (contentStage) {
            contentStage.addEventListener('click', (e) => {
                // Ignore clicks on buttons/interactive elements
                if (e.target.closest('button, a, input, .btn-console-run, .overview-modal')) return;
                nextSlide();
            });
        }
    }

    // Run initializer
    init();
});
