<div class="calender">


    <ul class="weekdays">
        @foreach ($labels as $label)
            <li>{{ $label->dayName }}</li>
        @endforeach
    </ul>

    <ul class="days">
        @foreach ($days as $day)
            <li class="{{ $day->isToday() ? 'today' : '' }}">
                <div class="wrapper">
                    <h6>{{ $day->format('j') }}</h6>
                    <div class="items">
                        @foreach ($classes->where('ClassDay', $day->dayOfWeek) as $class)
                            <span class="class">{{ $class->ClassTitle }}</span>
                        @endforeach
                        @foreach ($exams->where('TestDate', $day) as $exam)
                            <span class="exam">{{ $exam->TestTitle }}</span>
                        @endforeach
                    </div>
                </div>
            </li>
        @endforeach

    </ul>
</div>
