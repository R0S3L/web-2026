<?php
require_once __DIR__ . '/../home/database.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Создать пост</title>
    <meta charset="utf-8">
    <link href="../css/post_style.css" rel="stylesheet">
</head>
<body class="block">
    <?php include '../home/sidebar.php'; ?>

    <div class="create-post-container">
        <h2 class="page-title">Новый пост</h2>

        <input type="file" id="fileInput" accept="image/*" multiple style="display: none;">

        <div class="image-upload-zone" id="uploadZone">
            <div class="upload-placeholder" id="uploadPlaceholder">
                <div class="image-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                </div>
                <button type="button" class="btn-black-add" id="btnBlackAdd">Добавить фото</button>
            </div>

            <div class="create-slider" id="createSlider" style="display: none;">
                <div class="create-slider__track" id="sliderTrack"></div>
                
                <button type="button" class="slider-arrow prev" id="slidePrev">&lt;</button>
                <button type="button" class="slider-arrow next" id="slideNext">&gt;</button>
                
                <div class="create-slider__counter">
                    <span id="currentSlide">1</span>/<span id="totalSlides">1</span>
                </div>
            </div>
        </div>

        <div class="action-row">
            <button type="button" class="btn-link-add" id="btnLinkAdd">
                <span class="plus-icon">+</span> Добавить фото
            </button>
        </div>

        <div class="description-zone">
            <textarea id="postDescription" placeholder="Добавьте подпись..." rows="3"></textarea>
        </div>

        <div class="submit-zone">
            <button type="button" id="btnShare" class="btn-share" disabled>Поделиться</button>
        </div>
    </div>

    <script src="../js/post_scripts.js"></script>
</body>
</html>