<x-template.admin title="Processings" slug="processings">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Processings:</h3>
                    <table class="list">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Actions</th>
                            </tr>
                            @foreach ($currencies as $key => $currency)
                                <tr class="{{$key%2 ? 'row1':'row2'}}">
                                    <td>
                                        <span
                                            style="{{ $currency->status ? 'font-weight:bold' : '' }}">{{ $currency->display_name }}</span>
                                    </td>
                                    <td align="center">{{$currency->code}}</td>
                                    <td nowrap=""> <a
                                            href="{{ route('admin.processings.view', ['id' => $currency->id]) }}"
                                            class="sbmt btn-sm btn-info">edit</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <br />
    <br />
    <div class="alert alert-warning"> You can edit any payment processing in this section by clicking the "edit"
        link. <br><br> Any processing you add can't allow users to deposit just by themselves.
    </div>
    </x-tempe.admin>
