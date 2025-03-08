<x-template.admin :title="'Email Template #' . $template->id" slug="email-templates">
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
                    <h3>Edit Email Template: {{ $template->title }}</h3>
                    <form method="post">
                        @csrf
                        <table class="form">
                            <tbody>
                                <tr>
                                    <th>Subject:</th>
                                    <td><input type="text" name="subject" value="{{ $template->subject }}"
                                            class="inpts" size="100"></td>
                                </tr>
                                <tr>
                                    <th>Use Email Header?</th>
                                    <td> <select name="use_header" class="inpts">
                                            <option value="1" {{ $template->use_header == '1' ? 'selected' : '' }}>
                                                Yes
                                            </option>
                                            <option value="0" {{ $template->use_header == '0' ? 'selected' : '' }}>
                                                No
                                            </option>
                                        </select> </td>
                                </tr>
                                <tr>
                                    <th>Use Email Footer?</th>
                                    <td> <select name="user_footer" class="inpts">
                                            <option value="1"
                                                {{ $template->user_footer == '1' ? 'selected' : '' }}>
                                                Yes
                                            </option>
                                            <option value="0"
                                                {{ $template->user_footer == '0' ? 'selected' : '' }}>
                                                No
                                            </option>
                                        </select> </td>
                                </tr>
                                <tr>
                                    <th>Message:</th>
                                    <td>
                                        <textarea name="content" cols="100" rows="20" class="inpts">{{ $template->content }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <input type="submit" value="Update" class="btn-sm btn-success sbmt">
                                        <a class="sbmt btn-sm btn-danger"
                                            href="{{ route('admin.email-templates') }}">Cancel</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="alert alert-warning">{!! $template->description !!}</div>
                </td>
            </tr>
        </tbody>
    </table>
</x-template.admin>
