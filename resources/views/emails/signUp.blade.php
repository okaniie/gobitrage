<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject ?? 'Email' }}</title>
    <style>
        /* Add your email styles here */
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .footer { background-color: #f8f9fa; padding: 20px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        @if(Setting::get('email_header'))
            <div class="header">
                {!! Setting::get('email_header') !!}
            </div>
        @endif
        
        <div class="content">
            {!! $content !!}
        </div>
        
        @if(Setting::get('email_footer'))
            <div class="footer">
                {!! Setting::get('email_footer') !!}
            </div>
        @endif
    </div>
</body>
</html>