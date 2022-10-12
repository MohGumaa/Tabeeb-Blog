<?php
/**
 * Calculator Formula
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 
$attributes = get_query_var('attributes');

if ( isset( $attributes['formula'] ) ) {
    $formula = $attributes['formula'];
} else {
    $formula = '';
}
?>

<div class="calculator-container my-4">

    <?php if ( $formula == 'bmi'  ) : ?>
        <p id="Bmi-result" class="calculator-result"></p>
        <form id="calculateBmiForm" class="calculator-form">
            <div class="row gx-3">
                <div class="col-sm-6 col-12 mb-3 mb-sm-0">
                    <input type="number" id="height" class="form-control" placeholder="ادخال الطول (سم)" aria-describedby="ادخال الطول (سم)" min="100" max="250" oninput="setCustomValidity('')" required="" oninvalid="this.setCustomValidity('الرجاء ادخال قيمة الطول بشكل صحيح 100 و 250')">
                </div>
                <div class="col-sm-6 col-12 mb-3 mb-sm-0">
                    <input type="number" id="weight" class="form-control" placeholder="ادخال الوزن (كغ)" aria-describedby="ادخال الوزن (كغ)" min="30" max="250" oninput="setCustomValidity('')" required="" oninvalid="this.setCustomValidity('الرجاء ادخال قيمة الوزن بشكل صحيح 30 و 250')">
                </div>
            </div>
            <button type="submit" class="btn btn-info text-white w-100 mt-3 fs-5">احسب الان</button>
        </form>

        <script>
            // Select DOM
            const heightInput = document.querySelector("#height");
            const weightInput = document.querySelector("#weight");
            const calculateBmiForm = document.querySelector("#calculateBmiForm");
            const BmiResult = document.querySelector("#Bmi-result");
            let BMI, height, weight;

            calculateBmiForm.addEventListener("submit", e => {
                e.preventDefault();

                height = parseInt(heightInput.value);
                weight = parseInt(weightInput.value); 
                BMI = (weight / ((height * height)/ 10000)).toFixed(2); 

                if(BMI < 18.5){
                    BmiResult.innerHTML = `أقل من الوزن الطبيعي : <span>${BMI}</span>`;  
                }else if((BMI >= 18.5) && (BMI <= 24.99)){
                    BmiResult.innerHTML = `ضمن الوزن الطبيعي : <span>${BMI}</span>`;  
                }else if((BMI >= 25) && (BMI <= 29.99 )){
                    BmiResult.innerHTML = `أعلى من الوزن الطبيعي : <span>${BMI}</span>`;  
                }else if((BMI >= 30) && (BMI <= 34.99 )){
                    BmiResult.innerHTML = `سمنة درجة أولى (معتدلة) : <span>${BMI}</span>`;  
                }else if((BMI >= 35) && (BMI <= 39.99 )){
                    BmiResult.innerHTML = `سمنة درجة ثانية (متوسطة) : <span>${BMI}</span>`;  
                }else{
                    BmiResult.innerHTML = `سمنة درجة ثالثة (مفرطة) : <span>${BMI}</span>`;  
                }
                BmiResult.classList.add('py-2', 'px-3', 'my-3', 'bg-light', 'text-primary' , 'rounded', 'border', 'border-info');  
            });


        </script>

    <?php elseif ( $formula == 'pregnancy' ) : ?>
        <?php 
            $today = getdate();
            $days_in_month = cal_days_in_month(CAL_GREGORIAN, $today['mon'], $today['year']);
            $year = $today['year'];
            $previousyear = $today['year'] - 1;
        ?>

        <form class="calculator-form" id="calculatePregnancyForm">
            <div class="row g-3">
                <div class="col-md-3 col-sm-4 col-12">
                    <select class="form-select" name="day" id="day" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('من فضلك اﺧﺘﺮ اليوم')" required>
                        <option selected disabled value=""><?php echo esc_attr_x( 'اليوم', 'placeholder', 'understrap' ); ?></option>
                        <?php for ( $i = 1; $i <= $days_in_month; $i++ ) : ?>
                            <option name="<?php echo $i; ?>" value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-3 col-sm-4 col-12">
                    <select name="month" id="month" class="form-select" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('من فضلك اﺧﺘﺮ الشهر')" required>
                        <option selected disabled value=""><?php echo esc_attr_x( 'الشهر', 'placeholder', 'understrap' ); ?></option>
                        <option name="1" value="1">1</option>
                        <option name="2" value="2">2</option>
                        <option name="3" value="3">3</option>
                        <option name="4" value="4">4</option>
                        <option name="5" value="5">5</option>
                        <option name="6" value="6">6</option>
                        <option name="7" value="7">7</option>
                        <option name="8" value="8">8</option>
                        <option name="9" value="9">9</option>
                        <option name="10" value="10">10</option>
                        <option name="11" value="11">11</option>
                        <option name="12" value="12">12</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-4 col-12">
                    <select name="year" id="year" class="form-select" oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('من فضلك اﺧﺘﺮ السنة')" required>
                        <option selected disabled value=""><?php echo esc_attr_x( 'السنة', 'placeholder', 'understrap' ); ?></option>
                        <option value="<?php echo $previousyear ?>"><?php echo $previousyear ?></option>
                        <option value="<?php echo $year ?>"><?php echo $year ?></option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-12">
                    <button class="btn btn-info text-white w-100"><?php echo esc_attr_x( 'احسبي الأن', 'submit button', 'understrap' ); ?></button>
                </div>
            </div>
        </form>
        
        <div id="pregnancy-info" class="bg-info text-white rounded mt-4 mt-md-5 px-2 px-md-3 py-3 py-sm-2 d-none">
            <div class="row align-items-center">
                <div class="col-md-2 col-sm-2 mb-3 mb-sm-0">
                    <img src="<?php echo get_theme_file_uri( 'images/pregnancy-icon.svg' ); ?>" class="img-fluid img-pregnancy" alt="Pregnancy Icon">
                </div>
                <div class="col-md-4 col-sm-5 text-center text-sm-end">
                    <p class="fs-4 mb-2 mt-0">موعد الولادة المتوقع</p>
                    <p id="pregnancy-result" class="calculator-result fs-5 m-0"></p>
                </div>
                <div class="col-md-6 col-sm-5 text-center text-sm-start d-none d-sm-block">
                    <a href="<?php echo esc_url( get_tag_link( '83' ) ); ?>" class="btn btn-light text-primary ps-3">
                    تفاصيل اكثر إضغطي هنا
                    </a>
                </div>
            </div>
        </div>

        <div class="related-dates mt-4 d-none" id="extra-date">
            <div class="row">   
                <div class="col">
                    <div class="date-box mx-auto">
                        <div class="text-wrap">
                            <img width="176" height="192" src="<?php echo get_theme_file_uri( 'images/circle.png' ); ?>" alt="الحمل">
                            <span class="text bold">تواريخ الخصوبة المتوقعة</span>
                        </div>
                        <span id="date-one" class="btn btn-info text-white rounded-8 w-100">
                        </span>
                    </div>
                </div>
                <div class="col">
                    <div class="date-box mx-auto">
                        <div class="text-wrap">
                            <img width="176" height="192" src="<?php echo get_theme_file_uri( 'images/circle.png' ); ?>" alt="الحمل">
                            <span class="text bold">الثلث الأول من الحمل</span>
                        </div>
                        <span id="date-two" class="btn btn-info text-primary rounded-8 w-100">
                        </span>
                    </div>
                </div>
                <div class="col">
                    <div class="date-box mx-auto">
                        <div class="text-wrap">
                            <img width="176" height="192" src="<?php echo get_theme_file_uri( 'images/circle.png' ); ?>" alt="الحمل">
                            <span class="text bold">الثلث الثاني من الحمل</span>
                        </div>
                        <span id="date-three" class="btn btn-primary rounded-8 w-100">
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Select DOM
            const dayInput = document.querySelector("#day");
            const monthInput = document.querySelector("#month");
            const yearInput = document.querySelector("#year");  
            const dateOne = document.querySelector("#date-one");  
            const dateTwo = document.querySelector("#date-two");  
            const dateThree = document.querySelector("#date-three");  
            const extraDate = document.querySelector("#extra-date");  
            const PregnancyResult = document.querySelector("#pregnancy-result"); 
            const PregnancyInfo = document.querySelector("#pregnancy-info"); 
            const calculatePregnancyForm = document.querySelector("#calculatePregnancyForm");
            let day, month, $year;

            calculatePregnancyForm.addEventListener('submit', e => {
                e.preventDefault();
                const day   = dayInput.value;
                const month = monthInput.value;
                const year  = yearInput.value;
                const d = new Array("اﻷحد", "اﻷثنين", "الثلاثاء", "اﻷربعاء", "الخميس", "الجمعة", "السبت");
                const m = new Array("يناير", "فبراير", "مارس", "إبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر");

                const curd = new Date(year, month - 1 ,day);
                const res2 = curd.getMonth();
                const res = new Date();
                let diff = Date.UTC(res.getFullYear(),res.getMonth()-1,res.getDay(),0,0,0) - Date.UTC(curd.getFullYear(),curd.getMonth()-1,curd.getDay(),0,0,0);
                const secleft = diff/1000/60;
                const hrsleft = secleft/60;
                const daysleft = hrsleft/24;

                if ( year!=="" ) {
                    const fd1 = new Date(year, month - 1, parseInt(day)+10);
                    const fd2 = new Date(year, month-1, parseInt(day)+20);
                    dateOne.innerHTML = `
                    من ${fd1.getFullYear()}/${(fd1.getMonth() + 1).toString().padStart(2, "0")}/${fd1.getDate()}<br/>
                    الى ${fd2.getFullYear()}/${(fd2.getMonth() + 1).toString().padStart(2, "0")}/${fd2.getDate()}
                    `;

                    // Estimated Fertility Dates [Day of Fertility if they want to get perg]
                    const cd = new Date(year, month - 1, parseInt(day)+14);
                    const cdField = d[cd.getDay()]+", "+m[cd.getMonth()]+" "+cd.getDate()+", "+cd.getFullYear();
                    
                    // First Trimester Ends(12 Weeks) 
                    const fte = new Date(year, month-1, parseInt(day)+84);
                    dateTwo.innerHTML = `${fte.getFullYear()}/${(fte.getMonth() + 1).toString().padStart(2, "0")}/${fte.getDate()}`;

                    // Second Trimester Ends(27 Weeks)
                    const ste = new Date(year, month-1, parseInt(day)+189);
                    dateThree.innerHTML = `${ste.getFullYear()}/${(ste.getMonth() + 1).toString().padStart(2, "0")}/${ste.getDate()}`;

                    // Estimated Due Date(40 Weeks) 
                    const dd = new Date(year, month-1, parseInt(day)+280);
                    PregnancyResult.innerHTML = `${d[dd.getDay()]} - ${dd.getFullYear()}/${(dd.getMonth() + 1).toString().padStart(2, "0")}/${dd.getDate()}`;

                    // Get Month Different ( curd, today )👇️ 
                    const curMonth = getMonthDifference(curd, res);
                    const curWeek  = getWeeksDiff(curd, res);

                    console.log(curMonth , curWeek)

                    function getMonthDifference(startDate, endDate) {
                        return (
                            endDate.getMonth() -
                            startDate.getMonth() +
                            12 * (endDate.getFullYear() - startDate.getFullYear())
                        );
                    }

                    function getWeeksDiff(startDate, endDate) {
                        const msInWeek = 1000 * 60 * 60 * 24 * 7;
                        return Math.round(Math.abs(endDate - startDate) / msInWeek);
                    }


                    PregnancyInfo.classList.remove('d-none');

                }else{
                    alert("البيانات المدخلة غير صحيحة");
                }

            });

        </script>

    <?php endif; ?>

</div>

