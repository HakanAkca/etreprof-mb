@extends('emails.layout')

@section('content')

<!-- Greeting -->
<h1 style="{{ $style['header-1'] or '' }}">
    @if (! empty($greeting))
        {{ $greeting }}
    @else
        @if ($level == 'error')
            Whoops!
        @else
            Hello!
        @endif
    @endif
</h1>

<!-- Intro -->
@foreach ($introLines as $line)
    <p style="{{ $style['paragraph'] or '' }}">
        {{ $line }}
    </p>
@endforeach

<!-- Action Button -->
@if (isset($actionText))
    <table style="{{ $style['body_action'] or '' }}" align="center" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <?php
                    switch ($level) {
                        case 'success':
                            $actionColor = 'button--green';
                            break;
                        case 'error':
                            $actionColor = 'button--red';
                            break;
                        default:
                            $actionColor = 'button--blue';
                    }
                ?>

                <a href="{{ $actionUrl }}"
                    style="{{ $fontFamily or '' }} {{ $style['button'] or '' }} {{ $style[$actionColor] or '' }}"
                    class="button"
                    target="_blank">
                    {{ $actionText }}
                </a>
            </td>
        </tr>
    </table>
@endif

<!-- Outro -->
@foreach ($outroLines as $line)
    <p style="{{ $style['paragraph'] or '' }}">
        {{ $line }}
    </p>
@endforeach

<!-- Salutation -->
<p style="{{ $style['paragraph'] or '' }}">
    Cordialement,<br>
    L'équipe EtreProf
</p>

<!-- Sub Copy -->
@if (isset($actionText))
    <table style="{{ $style['body_sub'] or '' }}">
        <tr>
            <td style="{{ $fontFamily or '' }}">
                <p style="{{ $style['paragraph-sub'] or '' }}">
                    Si vous rencontrez des difficultés pour cliquer sur le bouton "{{ $actionText }}" vous pouvez copier-coller l'adresse suivante dans votre navigateur :
                </p>

                <p style="{{ $style['paragraph-sub'] or '' }}">
                    <a style="{{ $style['anchor'] or '' }}" href="{{ $actionUrl }}" target="_blank">
                        {{ $actionUrl }}
                    </a>
                </p>
            </td>
        </tr>
    </table>
@endif

@endsection