<?php
/**
 * The template for category medical case
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$term = get_queried_object();
$image = get_field('cat_picture', $term); 
get_header();
?>

<div class="page-wrapper pt-0 alphabetical-page" id="category-wrapper-alphabetical">
    <div class="hero-section" style="background-image: url('<?php echo $image['sizes']['large'] ?>')">
        <div class="container d-flex flex-column align-items-center h-100 pt-4 pt-lg-5 hero-content">
            <h1 class="text-white hero-title mb-3 mb-lg-4"><?php single_cat_title(); ?></h1>

            <div class="alphabetical-letters">
                <div class="input-group input-group-lg mb-3">
                    <input type="text" class="form-control rounded-right" id="filterInput" placeholder="أدخل إسم الفحص أو الحالة الطبية..." aria-label="أدخل إسم المرض أو الحالة الطبية" aria-describedby="basic-case">
                    <span class="input-group-text icon-search d-flex justify-content-center align-items-center rounded-left bg-info text-white fs-4" id="basic-case"></span>
                </div>
                <p class="text-primary fs-5 mb-3">ابحث عن اسم الفحص</p>
                <p class="title-with-bottom-br mb-3">الحروف العربية</p>
                <div class="alphabeta ar">
                    <a title="امراض تبدأ بحرف ا" href="#ا">ا</a>
                    <a title="امراض تبدأ بحرف ب" href="#ب">ب</a>
                    <a title="امراض تبدأ بحرف ت" href="#ت">ت</a>
                    <a title="امراض تبدأ بحرف ث" href="#ث">ث</a>
                    <a title="امراض تبدأ بحرف ج" href="#ج">ج</a>
                    <a title="امراض تبدأ بحرف ح" href="#ح">ح</a>
                    <a title="امراض تبدأ بحرف خ" href="#خ">خ</a>
                    <a title="امراض تبدأ بحرف د" href="#د">د</a>
                    <a title="امراض تبدأ بحرف ذ" href="#ذ">ذ</a>
                    <a title="امراض تبدأ بحرف ر" href="#ر">ر</a>
                    <a title="امراض تبدأ بحرف ز" href="#ز">ز</a>
                    <a title="امراض تبدأ بحرف س" href="#س">س</a>
                    <a title="امراض تبدأ بحرف ش" href="#ش">ش</a>
                    <a title="امراض تبدأ بحرف ص" href="#ص">ص</a>
                    <a title="امراض تبدأ بحرف ض" href="#ض">ض</a>
                    <a title="امراض تبدأ بحرف ط" href="#ط">ط</a>
                    <a title="امراض تبدأ بحرف ظ" href="#ظ">ظ</a>
                    <a title="امراض تبدأ بحرف ع" href="#ع">ع</a>
                    <a title="امراض تبدأ بحرف غ" href="#غ">غ</a>
                    <a title="امراض تبدأ بحرف ف" href="#ف">ف</a>
                    <a title="امراض تبدأ بحرف ق" href="#ق">ق</a>
                    <a title="امراض تبدأ بحرف ك" href="#ك">ك</a>
                    <a title="امراض تبدأ بحرف ل" href="#ل">ل</a>
                    <a title="امراض تبدأ بحرف م" href="#م">م</a>
                    <a title="امراض تبدأ بحرف ن" href="#ن">ن</a>
                    <a title="امراض تبدأ بحرف ه" href="#ه">ه</a>
                    <a title="امراض تبدأ بحرف و" href="#و">و</a>
                    <a title="امراض تبدأ بحرف ي" href="#ي">ي</a>
                </div>
            </div>
        </div>
    </div>

    <main class="site-main" id="main">
        <div class="container">

            <?php 
                 $cat_ID = get_query_var('cat');
                 $args   = array(
                    'post_status' => 'publish',
                    'posts_per_page'=> -1,
                    'cat' => $cat_ID,
                );

                $drugs_article = get_posts($args);

                if ( $drugs_article ) :
                    $arabic_alpha = array("ا", "ب", "ت", "ث", "ج", "ح", "خ", "د", "ذ", "ر", "ز", "س", "ش", "ص", "ض", "ط", "ظ", "ع", "غ", "ف", "ق", "ك", "ل", "م", "ن", "ه", "و", "ي");
                    foreach ( $arabic_alpha as $letter) :
            ?>

                <div class="tabeeb-cases empty" id="<?php echo $letter; ?>">
                    <h2>(<?php echo $letter;?>)</h2>
                    <div class="cases">
                        <?php
                            foreach ($drugs_article as $index => $item ) {
                                $caseName = get_field('short_taxonomic_name', $item->ID);
                                $caseNameEn = get_field('taxonomic_name_en', $item->ID);

                                if(empty($caseName)) {
                                    $caseName = $item->post_title;
                                }

                                if (mb_substr($caseName, 0, 1, 'utf8') == $letter) {
                                    echo '<h3 class="tabeeb-case"><a href="' . esc_url( get_permalink($item->ID) )  . '" data-index="'.$caseNameEn.'">' . $item->post_title  . '</a></h3>';
                                    unset($drugs_article[$index]); 
                                }
                            }
                        ?>
                    </div>
                </div>

            <?php endforeach; endif; ?>

        </div>
    </main>

</div>

<script>
    const tabeebCase = document.querySelectorAll('.tabeeb-case');
    const alphabetaLinks = document.querySelectorAll('.alphabeta a');
    let filterInput = document.querySelector('#filterInput');

    tabeebCase.forEach(item => {
        item.parentElement.parentElement.classList.remove('empty');
    });

    const tabeebCaseEmpty = document.querySelectorAll('.tabeeb-cases.empty');
    tabeebCaseEmpty.forEach(CaseEmpty => {
        CaseEmpty.remove();
    });

    alphabetaLinks.forEach(letter => {
        letter.addEventListener('click', ()=> {
            tabeebCase.forEach(link => {
                link.classList.remove('show-off');
                link.style.display = '';
                link.parentElement.parentElement.style.display = '';
            });
            filterInput.value = '';
        });
    });

    // Event Listener 
    filterInput.addEventListener('keyup', filterNames);

    function filterNames() {
        let filterValue = filterInput.value.toUpperCase();

        tabeebCase.forEach((link, index) => {
            let a = link.querySelector('a');
            let valueMatch;

            if ( isArabic(filterValue) ) {
                valueMatch = a.innerHTML.trim();
            } else {
                valueMatch = a.dataset.index.toUpperCase();
            }

            function isArabic(text) {
                var arabic = /[\u0600-\u06FF]/;
                result = arabic.test(text);
                return result;
            }

            if ( valueMatch.indexOf(filterValue) > -1 ) {
                link.style.display = '';
                link.parentElement.parentElement.style.display = '';
                link.classList.remove('show-off');
            } else {
                link.style.display = 'none';
                link.classList.add('show-off');

                const showOffLinks = link.parentElement.parentElement.querySelectorAll('h3:not(.show-off');

                if ( showOffLinks.length == 0 || showOffLinks.length < 1 ) {
                    link.parentElement.parentElement.style.display = 'none';
                }
            }

        });
    }


</script>

<?php
get_footer();
