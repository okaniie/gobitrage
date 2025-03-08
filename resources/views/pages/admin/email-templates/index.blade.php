<x-template.admin title="Email Templates" slug="email-templates">
    <script type="text/javascript" src="{{ asset('admin/nicedit/nicEdit.js') }}"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            nicEditors.allTextAreas({
                fullPanel: true
            })
        });
    </script>

    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>Edit E-mail Templates:</h3>
                    <table class="list">
                        <tbody>
                            @foreach ($templates as $item)
                                <tr class="row1">
                                    <td>{{ $item->title }}</td>
                                    <td><a href="{{ route('admin.email-templates.view', ['id' => $item->id]) }}"
                                            class="sbmt btn-sm btn-success">edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h3>Template Presets:</h3>
                    <form method="post" action="">
                        @csrf
                        <table class="form">
                            <tbody>
                                <tr class="row2">
                                    <th>Email Header:</th>
                                    <td>
                                        <textarea name="email_header" class="inpts" cols="100" rows="10">{{ $email_header }}</textarea>
                                    </td>
                                </tr>
                                <tr class="row2">
                                    <th>Email Footer:</th>
                                    <td>
                                        <textarea name="email_footer" class="inpts" cols="100" rows="10">{{ $email_footer }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><input type="submit" value="Update" class="sbmt btn-success"></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</x-template.admin>
