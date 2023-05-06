<div class="calender">


    <ul class="weekdays">
        <li>Mo</li>
        <li>Tu</li>
        <li>We</li>
        <li>Th</li>
        <li>Fr</li>
        <li>Sa</li>
        <li>Su</li>
    </ul>

    <ul class="days">
        @for ($i = 0; $i < 30; $i++)
            <li>
                <div class="wrapper">
                    <h6>1</h6>
                    <div class="items">
                        <span>Exam</span>
                        <span>Exam</span>
                    </div>
                </div>
            </li>
        @endfor

    </ul>
</div>
