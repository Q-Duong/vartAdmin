@foreach ($getAllRegisterFilter as $key => $register)
    <tr class="section-item">
        <td>{{ \Carbon\Carbon::parse($register->created_at)->format('H:i:s d/m/Y') }}</td>
        <td>{{ $register->id }}</td>
        <td>{{ $register->register_code }}</td>
        <td class="sticky-col first-col">{{ \Str::title($register->member->member_full_name) }}</td>
        <td>{{ $register->member->member_gender == 0 ? 'Nam' : 'Nữ' }}</td>
        <td>{{ $register->member->member_date }}</td>
        <td>{{ $register->member->member_month }}</td>
        <td>{{ $register->member->member_year }}</td>
        <td>{{ $register->member->member_email }}</td>
        <td>{{ $register->member->member_phone }}</td>
        <td>{{ $register->member->member_work_unit }}</td>
        <td>
            {{ $register->fees->implode('conference_fee_title', ', ') }}
        </td>
        <td>{{ $register->register_cme_type }}</td>
        <td>{{ $register->payment->payment_price < 1000 ? '$' . number_format($register->payment->payment_price, 2) : number_format($register->payment->payment_price, 0, ',', '.') . '₫' }}
        </td>
        <td>{{ $register->member->member_graduation_year }}</td>
        <td>
            @if ($register->member->member_image)
                <a href="https://drive.google.com/file/d/{{ $register->member->member_image }}/view" target="_blank">
                    @lang('conference.en.link')
                </a>
            @endif
        </td>
        <td>
            @if ($register->member->member_image_card)
                <a href="https://drive.google.com/file/d/{{ $register->member->member_image_card }}/view"
                    target="_blank">
                    @lang('conference.en.link')
                </a>
            @endif
        </td>
        <td>
            @if ($register->payment->payment_image)
                <a href="https://drive.google.com/file/d/{{ $register->payment->payment_image }}/view" target="_blank">
                    @lang('conference.en.link')
                </a>
            @endif
        </td>
        <td>
            @if ($register->payment->payment_status == 1)
                <span style="color: #27c24c;">@lang('conference.en.status.step1')
                @elseif ($register->payment->payment_status == 2)
                    <span style="color: #FCB322;">@lang('conference.en.status.step2')
                    @elseif ($register->payment->payment_status == 3)
                        <span style="color: #c037df;">@lang('conference.en.status.step3')
                        @elseif ($register->payment->payment_status == 4)
                            <span style="color: #0071e3;">@lang('conference.en.status.step4')
            @endif
        </td>
        <td class="management">
            <a href="{{ Route('conference_register.edit', [$conference->conference_code, $register->id]) }}"
                class="management-btn" title="@lang('vart_define.button.update')">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
            </a>
            <form action="{{ Route('conference_register.copy', [$conference->conference_code, $register->id]) }}"
                method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="management-btn button-submit" title="@lang('vart_define.button.copy')">
                    <i class="fa-regular fa-copy btn-copy"></i>
                </button>
            </form>
            @can('isAdmin')
                <form action="{{ Route('conference_register.destroy', $register->id) }}" method="POST" id="delete-form">
                    @method('delete')
                    @csrf
                    <button type="submit" class="management-btn button-delete" title="@lang('vart_define.button.delete')">
                        <i class="fa fa-times text-danger text"></i>
                    </button>
                </form>
            @endcan
            <form action="{{ Route('mail.reply', $register->id) }}" method="POST" id="mail-form-{{ $register->id }}">
                @csrf
                <input type="hidden" name="type" value="register">
                <button type="submit" class="management-btn button-submit button-mail" title="@lang('vart_define.button.mail')">
                    <i class="far fa-envelope btn-mail"></i>
                </button>
            </form>
        </td>
    </tr>
@endforeach
