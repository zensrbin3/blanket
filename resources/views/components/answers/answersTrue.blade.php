@props(['is_correct', 'answer_description', 'letter'])

@if($is_correct)
    <td style="width: 20px; text-align: center; vertical-align: top; padding-top: 10px; ">
        <div style="padding-left:5%; display: inline-block; width: 40%; vertical-align: top; text-align: left;"><strong>{{$letter}})</strong></div>
    </td>
    <td style=" padding: 10px">
        {!! $answer_description !!}
    </td>
@else
    <td style="width: 20px; text-align: center; vertical-align: top; padding-top: 10px; ">
        <div style="padding-left:5%; display: inline-block; width: 40%; vertical-align: top; text-align: left;">{{$letter}})</div>
    </td>
    <td style="padding: 10px">
        {!! $answer_description !!}
    </td>
@endif
