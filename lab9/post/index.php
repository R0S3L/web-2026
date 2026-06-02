<?php
require_once __DIR__ . '/../home/database.php';

session_start();
$userId = $_SESSION['user_id'] ?? 1; // Default to user 1 for testing
$postId = isset($_GET['post_id']) ? (int)$_GET['post_id'] : null;
$isEditing = $postId !== null;
$pageTitle = $isEditing ? 'Редактирование поста' : 'Новый пост';
$buttonText = $isEditing ? 'Сохранить' : 'Поделиться';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta charset="utf-8">
    <link href="../css/post_style.css" rel="stylesheet">
</head>
<body class="block">
    <?php include '../home/sidebar.php'; ?>

    <div class="create-post-container">
        <h2 class="page-title"><?php echo htmlspecialchars($pageTitle); ?></h2>

        <div id="successMessage" class="success-message" style="display: none;">
            ✓ Пост успешно сохранен!
        </div>

        <div id="errorMessage" class="error-message" style="display: none;"></div>
          <div id="formContainer">
            <input type="file" id="fileInput" accept="image/*" multiple style="display: none;">
            <input type="hidden" id="userId" value="<?php echo htmlspecialchars($userId); ?>">
            <input type="hidden" id="postId" value="<?php echo htmlspecialchars($postId ?? ''); ?>">
            <input type="hidden" id="isEditing" value="<?php echo htmlspecialchars($isEditing ? '1' : '0'); ?>">

            <div class="image-upload-zone" id="uploadZone">
                <div class="upload-placeholder" id="uploadPlaceholder">
                    <div class="image-icon">
                        <img src="../images/icons/image_post_icon.png" width="100px" height="100px">
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
               <button type="button" id="btnShare" class="btn-share" disabled><?php echo htmlspecialchars($buttonText); ?></button>
            </div>
        </div>
    </div>

    <script src="../js/post_scripts.js"></script>
</body>
</html>