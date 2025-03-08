<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailTemplateRequest;
use App\Models\EmailTemplate;
use App\Models\Setting;
use Illuminate\Http\Request;

class EmailTemplatesController extends Controller
{
    public function index()
    {
        return view('pages.admin.email-templates.index', [
            'templates' => EmailTemplate::orderBy('title', 'DESC')->get()->all(),
            'email_header' => Setting::get('email_header'),
            'email_footer' => Setting::get('email_footer'),
        ]);
    }

    public function viewSingle($id)
    {
        return view('pages.admin.email-templates.view', ['template' => EmailTemplate::findorFail($id)]);
    }

    public function updateHeaderFooter(Request $request)
    {
        $request->validate([
            'email_header' => 'nullable|string',
            'email_footer' => 'nullable|string'
        ]);

        Setting::set('email_header', $request->email_header);
        Setting::set('email_footer', $request->email_footer);

        return back()->with("success", "Email header and footer updated successfully.");
    }

    public function update(EmailTemplateRequest $request, $id)
    {
        $valid = $request->validated();

        $update = EmailTemplate::findOrFail($id)->update([
            'content' => $valid['content'],
            'subject' => $valid['subject'],
        ]);

        if (empty($update)) {
            return back()->with('error', "Unable to update template at the moment.");
        } else {
            return back()->with('success', "Template updated successfully.");
        }
    }
}
