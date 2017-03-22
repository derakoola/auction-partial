<ul>
    @if($bidRules)

        @foreach($bidRules as $key=>$bidRule)
            @if(count($bidRules) == 1)
                <li> هر مرحله{{$key}} تومان</li>
            @else
        @if($bidRule == reset($bidRules))
            <li>از صفر تومان تا {{$bidRule}} تومان هر مرحله {{$key}} تومان</li>
        @elseif($bidRule == end($bidRules))
            <li> به بعد هر مرحله{{$key}} تومان</li>
            @else
                <li>تا {{$bidRule}} تومان هر مرحله {{$key}} تومان</li>
                @endif

        @endif
    @endforeach
        @endif
</ul>