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

        <p id="Bmi-result" class="border border-info rounded my-3 py-2 px-3 text-primary calculator-result"></p>

        <form id="calculateBmiForm" class="calculator-form">
            <div class="row gx-3">
                <div class="col-sm-6 col-12 mb-3 mb-sm-0">
                    <input type="number" id="height" class="form-control" placeholder="ادخال الطول (سم)" aria-describedby="ادخال الطول (سم)" min="100" max="250" oninput="setCustomValidity('')" required="" oninvalid="this.setCustomValidity('ادخال قيمة الطول بشكل صحيح 100 و 250')">
                </div>
                <div class="col-sm-6 col-12 mb-3 mb-sm-0">
                    <input type="number" id="weight" class="form-control" placeholder="ادخال الوزن (كغ)" aria-describedby="ادخال الوزن (كغ)" min="30" max="250" oninput="setCustomValidity('')" required="" oninvalid="this.setCustomValidity('ادخال قيمة الوزن بشكل صحيح 30 و 250')">
                </div>
            </div>
            <button type="submit" class="btn btn-info text-white w-100 mt-3 fs-5">احسب الان</button>
        </form>

        <div id="loader-bounce" class="loader d-none mt-5">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <script>
            // Select DOM
            const heightInput = document.querySelector("#height");
            const weightInput = document.querySelector("#weight");
            const calculateBmiForm = document.querySelector("#calculateBmiForm");
            const BmiResult = document.querySelector("#Bmi-result");
            const loader = document.querySelector("#loader-bounce");
            let BMI, height, weight;

            calculateBmiForm.addEventListener("submit", e => {
                e.preventDefault();

                loader.classList.remove('d-none');
                BmiResult.style.display = 'none';
                BmiResult.style.opacity = 0;

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
                setTimeout(() => {
                    loader.classList.add('d-none');
                    BmiResult.style.display = 'block';
                    setTimeout(() => {
                        BmiResult.style.opacity = 1;
                    }, 50);
                }, 2500);
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

        <div id="spinner-loader" class="spinner-container mt-5 d-none">
            <div class="spinner"></div>
        </div>
        
        <div id="pregnancy-info" class="bg-pink text-white rounded mt-4 mt-md-5 px-2 px-md-3 py-3 py-sm-2 calculator-result">
            <div class="row align-items-center">
                <div class="col-md-2 col-sm-2 mb-3 mb-sm-0">
                    <img src="<?php echo get_theme_file_uri( 'images/pregnancy-icon.svg' ); ?>" class="img-fluid img-pregnancy" alt="Pregnancy Icon">
                </div>
                <div class="col-md-4 col-sm-5 text-center text-sm-end">
                    <p class="fs-4 mb-2 mt-0">موعد الولادة المتوقع</p>
                    <p id="pregnancy-result" class="fs-5 m-0"></p>
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
            const spinnerLoader = document.querySelector("#spinner-loader");  
            const PregnancyResult = document.querySelector("#pregnancy-result"); 
            const PregnancyInfo = document.querySelector("#pregnancy-info"); 
            const calculatePregnancyForm = document.querySelector("#calculatePregnancyForm");
            let day, month, $year;

            calculatePregnancyForm.addEventListener('submit', e => {
                e.preventDefault();

                spinnerLoader.classList.remove('d-none');
                PregnancyInfo.style.opacity = 0;
                PregnancyInfo.style.display = 'none';

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

                    // console.log(curMonth , curWeek)

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

                    setTimeout(() => {
                        spinnerLoader.classList.add('d-none');
                        PregnancyInfo.style.display = 'block';
                        setTimeout(() => {
                            PregnancyInfo.style.opacity = 1;
                        }, 50);
                    }, 1500);

                }else{
                    alert("البيانات المدخلة غير صحيحة");
                }

            });

        </script>

    <?php elseif ( $formula == 'ovulation' ) : ?>

        <form class="calculator-form bg-pink text-white py-4 px-3 calculator-info" id="calculateOvulation">
            <div class="mb-3">
                <label for="period-tracker" class="form-label">متى بدأت دورتك الشهرية الأخيرة؟</label>
                <input type="date" class="form-control" id="period-tracker" oninput="setCustomValidity('')" required="" oninvalid="this.setCustomValidity('اختاري التاريخ')">
            </div>
            <div class="mb-3">
                <label for="cycle" class="form-label">ما هي مدّة دورة الحيض لديك؟</label>
                <select id="cycle" class="form-select">
                    <?php for( $cycle = 21; $cycle <= 40; $cycle++ ) :?>
                        <option value="<?php echo $cycle; ?>" <?php echo $cycle === 28 ? "selected" : ""; ?>><?php  echo $cycle ; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-light rounded text-pink w-100 mb-3 fs-5">احسبي الأن</button>
            <span class="fs-small">قد لا تكون نتائج متتبع الدورة الشهرية دقيقة بنسبة 100٪ وذلك لأن كل جسم وكل دورة تختلف عن الأخرى.</span>
        </form>

        <div id="spinner-loader" class="spinner-container mt-5 d-none">
            <div class="spinner"></div>
        </div>

        <div id="ovulation-result" class="calculator_table calculator-result mt-5">
            <div class="row gx-2 gx-md-3 result-days mb-4">
                <div class="col">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center result">
                        <img src="<?php echo get_theme_file_uri( 'images/HealthtoolOvulation.svg' ); ?>" alt="ovulation-Health">
                        <span>آخر<br>دورة شهرية</span>
                    </div>
                    <div class="dates border-dashed border-one">
                        <span id="lastPeriod-month" class="d-block text-center"></span>
                        <span id="lastPeriod-day" class="d-block text-center"></span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center result fertile">
                        <img src="<?php echo get_theme_file_uri( 'images/ovulation-circle-icon.svg' ); ?>" alt="ovulation-icon">
                        <span>ايام<br>التبويض</span>
                    </div>
                    <div class="dates border-dashed border-one">
                        <span id="fertile-start" class="d-block text-center"></span>
                        <span id="fertile-end" class="d-block text-center"></span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center result period">
                        <img src="<?php echo get_theme_file_uri( 'images/ovulation-icon.svg' ); ?>" alt="ovulation-icon">
                        <span>الدورة<br>القادمة</span>
                    </div>
                    <div class="dates border-dashed border-one">
                        <span id="nextPeriod-month" class="d-block text-center"></span>
                        <span id="nextPeriod-day" class="d-block text-center"></span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center result next-period">
                        <img src="<?php echo get_theme_file_uri( 'images/ovulation-calc-shape.svg' ); ?>" alt="ovulation-calc">
                        <span>تاريخ<br>الولادة</span>
                    </div>
                    <div class="dates border-dashed border-one">
                        <span id="expect-due" class="d-block text-center"></span>
                        <span id="due-month" class="d-block text-center"></span>
                    </div>
                </div>
            </div>

            <!-- Calendar -->
            <div class="container-calendar pt-3">
                <h3 id="monthAndYear" class="text-center mb-3  mt-0"></h3>
                <table class="table-calendar" id="calendar" data-lang="en">
                    <thead id="thead-month"></thead>
                    <tbody id="calendar-body"></tbody>
                </table>
            </div>
            <p id="table-due" class="text-muted text-center fs-small"></p>
            <p class="fs-6 mt-4 mt-md-5">الجدول أدناه سوف تعطيك فكرة للأشهر الاربعة المقبلة:</p>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ايام الدورة</th>
                            <th scope="col">ايام التبويض المتوقعة</th>
                            <th scope="col">بداية الدورة القادمة</th>
                            <th scope="col">تاريخ الولادة المتوقع</th>
                        </tr>
                    </thead>
                    <tbody id="body-result">
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            const months = [
                "يناير", "فبراير", "مارس", "إبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
            ];
            const weekDays = [
                "اﻷحد", "اﻷثنين", "الثلاثاء", "اﻷربعاء", "الخميس", "الجمعة", "السبت"
            ];

            const calculateOvulation = document.querySelector("#calculateOvulation");
            const ovulationResult = document.querySelector("#ovulation-result");
            const spinner = document.querySelector(".spinner-container");

            calculateOvulation.addEventListener('submit', e => { 
                e.preventDefault();

                // Select DOM
                const periodTracker = document.querySelector("#period-tracker").value;
                const cycle = document.querySelector("#cycle").value;
                const lastPeriodMonth = document.querySelector("#lastPeriod-month");
                const lastPeriodDay = document.querySelector("#lastPeriod-day");
                const fertileStart = document.querySelector("#fertile-start");
                const fertileEnd = document.querySelector("#fertile-end");
                const nextPeriodMonth = document.querySelector("#nextPeriod-month");
                const nextPeriodDay = document.querySelector("#nextPeriod-day");
                const expectDue = document.querySelector("#expect-due");
                const dueMonth = document.querySelector("#due-month");
                const tableDue = document.querySelector("#table-due");
                const bodyResult = document.querySelector("#body-result");

                spinner.classList.remove('d-none');
                ovulationResult.style.display = 'none';
                ovulationResult.style.opacity = 0;

                const currentPeriod = new Date(`${periodTracker}`);
                const firstDayTime  = new Date(`${periodTracker}`);
                const lastDayTime  = new Date(`${periodTracker}`);
                const dueDateTime  = new Date(`${periodTracker}`);

                firstDayTime.setDate(firstDayTime.getDate() + parseInt(cycle) - 16 );
                lastDayTime.setDate(lastDayTime.getDate() + parseInt(cycle) - 12 );
	            const diffDue = parseInt(cycle)- 28;
                dueDateTime.setDate(dueDateTime.getDate() + 280 - parseInt(diffDue) ); // Have to adjust due date Due date currentPeriod + 280 days
                
                // Next Period One
                const nextPeriod1 = new Date(`${periodTracker}`);
                nextPeriod1.setDate(nextPeriod1.getDate() + parseInt(cycle));
                const firstDayTime1  = new Date(`${nextPeriod1}`);
                const lastDayTime1  = new Date(`${nextPeriod1}`);
                const dueDateTime1  = new Date(`${nextPeriod1}`);
                firstDayTime1.setDate(firstDayTime1.getDate() + parseInt(cycle) - 16 );
                lastDayTime1.setDate(lastDayTime1.getDate() + parseInt(cycle) - 12 );
                dueDateTime1.setDate(dueDateTime1.getDate() + 280 - parseInt(diffDue) ); // Have to adjust due date Due date currentPeriod + 280 days
                
                // Next Period Two
                const nextPeriod2 = new Date(`${nextPeriod1}`);
                nextPeriod2.setDate(nextPeriod2.getDate() + parseInt(cycle));
                const firstDayTime2  = new Date(`${nextPeriod2}`);
                const lastDayTime2  = new Date(`${nextPeriod2}`);
                const dueDateTime2  = new Date(`${nextPeriod2}`);
                firstDayTime2.setDate(firstDayTime2.getDate() + parseInt(cycle) - 16 );
                lastDayTime2.setDate(lastDayTime2.getDate() + parseInt(cycle) - 12 );
                dueDateTime2.setDate(dueDateTime2.getDate() + 280 - parseInt(diffDue) ); // Have to adjust due date Due date currentPeriod + 280 days
                
                // Next Period Three
                const nextPeriod3 = new Date(`${nextPeriod2}`);
                nextPeriod3.setDate(nextPeriod3.getDate() + parseInt(cycle));
                const firstDayTime3  = new Date(`${nextPeriod3}`);
                const lastDayTime3  = new Date(`${nextPeriod3}`);
                const dueDateTime3  = new Date(`${nextPeriod3}`);
                firstDayTime3.setDate(firstDayTime3.getDate() + parseInt(cycle) - 16 );
                lastDayTime3.setDate(lastDayTime3.getDate() + parseInt(cycle) - 12 );
                dueDateTime3.setDate(dueDateTime3.getDate() + 280 - parseInt(diffDue) ); // Have to adjust due date Due date currentPeriod + 280 days
                
                // Next Period Four
                const nextPeriod4 = new Date(`${nextPeriod3}`);
                nextPeriod4.setDate(nextPeriod4.getDate() + parseInt(cycle));

                // Show Date
                currentMonth = firstDayTime.getMonth();
                currentYear = firstDayTime.getFullYear();

                let calendar = document.getElementById("calendar");
                let lang = calendar.getAttribute('data-lang');

                const months = ["يناير", "فبراير", "مارس", "إبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"];
                const days = ["ح", "ن", "ث", "ر", "خ", "ج", "س"];

                let $dataHead = "<tr>";
                for (dhead in days) {
                    $dataHead += "<th data-days='" + days[dhead] + "'>" + days[dhead] + "</th>";
                }
                $dataHead += "</tr>";

                //alert($dataHead);
                document.getElementById("thead-month").innerHTML = $dataHead;

                monthAndYear = document.getElementById("monthAndYear");
                showCalendar(currentMonth, currentYear);

                function showCalendar(month, year) {
                
                    let firstDay = ( new Date( year, month ) ).getDay();
                    tbl = document.getElementById("calendar-body");
                    tbl.innerHTML = "";
                    monthAndYear.innerHTML = months[month] + " " + year;
            
                    // creating all cells
                    let date = 1;
                    for ( var i = 0; i < 6; i++ ) {
                        var row = document.createElement("tr");
                        
                        for ( var j = 0; j < 7; j++ ) {
                            if ( i === 0 && j < firstDay ) {
                                cell = document.createElement( "td" );
                                cellText = document.createTextNode("");
                                cell.appendChild(cellText);
                                row.appendChild(cell);
                            } else if (date > daysInMonth(month, year)) {
                                break;
                            } else {
                                cell = document.createElement("td");
                                cell.setAttribute("data-date", date);
                                cell.setAttribute("data-month", month + 1);
                                cell.setAttribute("data-year", year);
                                cell.setAttribute("data-month_name", months[month]);
                                cell.className = "date-picker";
                                cell.innerHTML = "<span>" + date + "</span>";
                
                                if ( date === firstDayTime.getDate() && year === firstDayTime.getFullYear() && month === firstDayTime.getMonth() ) {
                                    cell.className = "date-picker selected";
                                }
                                row.appendChild(cell);
                                date++;
                            }
                        }
                
                        tbl.appendChild(row);
                    }
                }

                function daysInMonth(iMonth, iYear) {
                    return 32 - new Date(iYear, iMonth, 32).getDate();
                }

                // Table Fill
                let output = '';
                output += `
                    <tr>
                        <td>
                            ${currentPeriod.getDate().toString().padStart(2, "0")} ${months[currentPeriod.getMonth()]} ${currentPeriod.getFullYear()}
                        </td>
                        <td>
                            ${firstDayTime.getDate().toString().padStart(2, "0")} ${months[firstDayTime.getMonth()]} ${firstDayTime.getFullYear()} - 
                            ${lastDayTime.getDate().toString().padStart(2, "0")} ${months[lastDayTime.getMonth()]} ${lastDayTime.getFullYear()}
                        </td>
                        <td>
                            ${nextPeriod1.getDate().toString().padStart(2, "0")} ${months[nextPeriod1.getMonth()]} ${nextPeriod1.getFullYear()}
                        </td>
                        <td>
                            ${dueDateTime.getDate().toString().padStart(2, "0")} ${months[dueDateTime.getMonth()]} ${dueDateTime.getFullYear()}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ${nextPeriod1.getDate().toString().padStart(2, "0")} ${months[nextPeriod1.getMonth()]} ${nextPeriod1.getFullYear()}
                        </td>
                        <td>
                            ${firstDayTime1.getDate().toString().padStart(2, "0")} ${months[firstDayTime1.getMonth()]} ${firstDayTime1.getFullYear()} - 
                            ${lastDayTime1.getDate().toString().padStart(2, "0")} ${months[lastDayTime1.getMonth()]} ${lastDayTime1.getFullYear()}
                        </td>
                        <td>
                            ${nextPeriod2.getDate().toString().padStart(2, "0")} ${months[nextPeriod2.getMonth()]} ${nextPeriod2.getFullYear()}
                        </td>
                        <td>
                            ${dueDateTime1.getDate().toString().padStart(2, "0")} ${months[dueDateTime1.getMonth()]} ${dueDateTime1.getFullYear()}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ${nextPeriod2.getDate().toString().padStart(2, "0")} ${months[nextPeriod2.getMonth()]} ${nextPeriod2.getFullYear()}
                        </td>
                        <td>
                            ${firstDayTime2.getDate().toString().padStart(2, "0")} ${months[firstDayTime2.getMonth()]} ${firstDayTime2.getFullYear()} - 
                            ${lastDayTime2.getDate().toString().padStart(2, "0")} ${months[lastDayTime2.getMonth()]} ${lastDayTime2.getFullYear()}
                        </td>
                        <td>
                            ${nextPeriod3.getDate().toString().padStart(2, "0")} ${months[nextPeriod3.getMonth()]} ${nextPeriod3.getFullYear()}
                        </td>
                        <td>
                            ${dueDateTime2.getDate().toString().padStart(2, "0")} ${months[dueDateTime2.getMonth()]} ${dueDateTime2.getFullYear()}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ${nextPeriod3.getDate().toString().padStart(2, "0")} ${months[nextPeriod3.getMonth()]} ${nextPeriod3.getFullYear()}
                        </td>
                        <td>
                            ${firstDayTime3.getDate().toString().padStart(2, "0")} ${months[firstDayTime3.getMonth()]} ${firstDayTime3.getFullYear()} - 
                            ${lastDayTime3.getDate().toString().padStart(2, "0")} ${months[lastDayTime3.getMonth()]} ${lastDayTime3.getFullYear()}
                        </td>
                        <td>
                            ${nextPeriod4.getDate().toString().padStart(2, "0")} ${months[nextPeriod4.getMonth()]} ${nextPeriod4.getFullYear()}
                        </td>
                        <td>
                            ${dueDateTime3.getDate().toString().padStart(2, "0")} ${months[dueDateTime3.getMonth()]} ${dueDateTime3.getFullYear()}
                        </td>
                    </tr>
                `;

                // Add Value
                lastPeriodMonth.innerHTML = months[currentPeriod.getMonth()];
                lastPeriodDay.innerHTML = `${currentPeriod.getDate().toString().padStart(2, "0")} - ${(currentPeriod.getMonth() + 1).toString().padStart(2, "0")}`;
                fertileStart.innerHTML = `${firstDayTime.getDate().toString().padStart(2, "0")} - ${(firstDayTime.getMonth() + 1).toString().padStart(2, "0")}`;
                fertileEnd.innerHTML = `${lastDayTime.getDate().toString().padStart(2, "0")} - ${(lastDayTime.getMonth() + 1).toString().padStart(2, "0")}`;
                nextPeriodMonth.innerHTML = months[nextPeriod1.getMonth()];
                nextPeriodDay.innerHTML = `${nextPeriod1.getDate().toString().padStart(2, "0")} - ${(nextPeriod1.getMonth() + 1).toString().padStart(2, "0")}`;
                expectDue.innerHTML = months[dueDateTime.getMonth()];
                dueMonth.innerHTML = `${dueDateTime.getDate().toString().padStart(2, "0")} - ${(dueDateTime.getMonth() + 1).toString().padStart(2, "0")}`;

                tableDue.innerHTML = `تاريخ الولادة المتوقع ${dueDateTime.getDate().toString().padStart(2, "0")} ${months[dueDateTime.getMonth()]} ${dueDateTime.getFullYear()}`;
                bodyResult.innerHTML = output;

                setTimeout(() => {
                    spinner.classList.add('d-none');
                    ovulationResult.style.display = 'block';
                    setTimeout(() => {
                        ovulationResult.style.opacity = 1;
                    }, 50);
                }, 2500);

            });

        </script>

    <?php endif; ?>
</div>

