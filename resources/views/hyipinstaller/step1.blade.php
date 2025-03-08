<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>HYIP Installation Script</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class=""></div>
    <main class="m-auto bg-dark text-white px-3 py-3 my-3" style="max-width: 560px">
        <form method="POST">
            @csrf
            <h1 class="text-center">HYIP Installation Script</h1>
            <p class="text-center">Step 1</p>
            <hr />
            <div class="text-center">
                <h3>Database Information</h3>
                <small><em>Create a database, assign necessary priviledges and enter the details here</em></small>
                <hr />
            </div>

            <div class="row g-3">
                <div class="form-group col-md-6">
                    <label for="DB_CONNECTION">Connection</label>
                    <select name="DB_CONNECTION" id="DB_CONNECTION" class="form-control" required>
                        <option value="mysql">MySQL</option>
                        <option value="postgres">PostgreSQL</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="DB_HOST">Host</label>
                    <input name="DB_HOST" id="DB_HOST" class="form-control" value="{{ old('DB_HOST', $DB_HOST) }}"
                        required />
                </div>
                <div class="form-group col-md-6">
                    <label for="DB_PORT">Port</label>
                    <input name="DB_PORT" id="DB_PORT" class="form-control" value="{{ old('DB_PORT', $DB_PORT) }}"
                        required />
                </div>
                <div class="form-group col-md-6">
                    <label for="DB_DATABASE">Database Name</label>
                    <input name="DB_DATABASE" id="DB_DATABASE" class="form-control"
                        value="{{ old('DB_DATABASE', $DB_DATABASE) }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="DB_USERNAME">Username</label>
                    <input name="DB_USERNAME" id="DB_USERNAME" class="form-control"
                        value="{{ old('DB_USERNAME', $DB_USERNAME) }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="DB_PASSWORD">Password</label>
                    <input name="DB_PASSWORD" id="DB_PASSWORD" class="form-control"
                        value="{{ old('DB_PASSWORD', $DB_PASSWORD) }}" required />
                </div>
            </div>

            <hr />

            <div class="text-center">
                <h3>Mail Information</h3>
                <small>
                    <em>Fill in the details that will be used to send notification emails.</em>
                </small>
                <hr />
            </div>

            <div class="row g-3">
                <div class="form-group col-md-6">
                    <label for="MAIL_MAILER">Mailer</label>
                    <select name="MAIL_MAILER" id="MAIL_MAILER" class="form-control" required>
                        <option value="smtp">SMTP</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="MAIL_ENCRYPTION">Encryption</label>
                    <select name="MAIL_ENCRYPTION" id="MAIL_ENCRYPTION" class="form-control" required>
                        <option value="none">None</option>
                        <option value="tls">TLS</option>
                        <option value="ssl">SSL</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="MAIL_HOST">Host</label>
                    <input name="MAIL_HOST" id="MAIL_HOST" class="form-control"
                        value="{{ old('MAIL_HOST', $MAIL_HOST) }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="MAIL_PORT">Port</label>
                    <input name="MAIL_PORT" id="MAIL_PORT" class="form-control"
                        value="{{ old('MAIL_PORT', $MAIL_PORT) }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="MAIL_USERNAME">Username</label>
                    <input name="MAIL_USERNAME" id="MAIL_USERNAME" class="form-control"
                        value="{{ old('MAIL_USERNAME', $MAIL_USERNAME) }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="MAIL_PASSWORD">Password</label>
                    <input name="MAIL_PASSWORD" id="MAIL_PASSWORD" class="form-control"
                        value="{{ old('MAIL_PASSWORD', $MAIL_PASSWORD) }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="MAIL_FROM_ADDRESS">Email for sending emails</label>
                    <input name="MAIL_FROM_ADDRESS" id="MAIL_FROM_ADDRESS" class="form-control"
                        value="{{ old('MAIL_FROM_ADDRESS', $MAIL_FROM_ADDRESS) }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="MAIL_FROM_NAME">Name for sending emails</label>
                    <input name="MAIL_FROM_NAME" id="MAIL_FROM_NAME" class="form-control"
                        value="{{ old('MAIL_FROM_NAME', $MAIL_FROM_NAME) }}" required />
                </div>
            </div>

            <hr />

            <div class="text-center">
                <h3>Site Information</h3>
                <small><em>Enter details about your company and website. These details will be available to your
                        frontend
                        engineers.</em></small>
                <hr />
            </div>

            <div class="row g-3">
                <div class="form-group col-md-6">
                    <label for="SITE_NAME">Name / Title</label>
                    <input name="SITE_NAME" id="SITE_NAME" class="form-control"
                        value="{{ old('SITE_NAME', $SITE_NAME) }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="SITE_DESCRIPTION">Description / Summary</label>
                    <input name="SITE_DESCRIPTION" id="SITE_DESCRIPTION" class="form-control"
                        value="{{ old('SITE_DESCRIPTION', $SITE_DESCRIPTION) }}" />
                </div>
                <div class="form-group col-md-6">
                    <label for="SITE_EMAIL">Support Email</label>
                    <input name="SITE_EMAIL" id="SITE_EMAIL" class="form-control"
                        value="{{ old('SITE_EMAIL', $SITE_EMAIL) }}" />
                </div>
                <div class="form-group col-md-6">
                    <label for="SITE_ADDRESS">Company Address</label>
                    <input name="SITE_ADDRESS" id="SITE_ADDRESS" class="form-control"
                        value="{{ old('SITE_ADDRESS', $SITE_ADDRESS) }}" />
                </div>
                <div class="form-group col-md-6">
                    <label for="SITE_PHONE1">Company Phone 1</label>
                    <input name="SITE_PHONE1" id="SITE_PHONE1" class="form-control"
                        value="{{ old('SITE_PHONE1', $SITE_PHONE1) }}" />
                </div>
                <div class="form-group col-md-6">
                    <label for="SITE_PHONE2">Company Phone 2</label>
                    <input name="SITE_PHONE2" id="SITE_PHONE2" class="form-control"
                        value="{{ old('SITE_PHONE2', $SITE_PHONE2) }}" />
                </div>
            </div>

            <hr />

            <div class="text-center">
                <h3>Installation Settings</h3>
                <small><em>Technical setup information.</em></small>
                <hr />
            </div>

            <div class="row g-3">
                <div class="form-group col-md-6">
                    <label for="ACTIVE_THEME">Active Theme</label>
                    <select name="ACTIVE_THEME" id="ACTIVE_THEME" class="form-control" required>
                        @foreach ($INSTALLED_THEMES as $theme)
                            <option>{{ $theme }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="APP_ENV">App Environment</label>
                    <select name="APP_ENV" id="APP_ENV" class="form-control" required>
                        <option value="prod">Production</option>
                        <option value="dev">Development</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="APP_DEBUG">Debug Mode</label>
                    <select name="APP_DEBUG" id="APP_DEBUG" class="form-control" required>
                        <option value="false">Off</option>
                        <option value="true">On</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="APP_TIMEZONE">Time Zone (e.g. Europe/London)</label>
                    <input name="APP_TIMEZONE" id="APP_TIMEZONE" class="form-control"
                        value="{{ old('APP_TIMEZONE', $APP_TIMEZONE) }}" required />
                </div>
            </div>

            {{-- <hr />

            <div class="text-center">
                <h3>Security Information</h3>
                <small><em>Set a password you can remember.</em></small>
                <hr />
            </div>

            <div class="row g-3">
                <div class="form-group col-md-12">
                    <label for="INSTALLER_PASSWORD">Installer Password</label>
                    <input name="INSTALLER_PASSWORD" id="INSTALLER_PASSWORD" class="form-control"
                        value="{{ old('INSTALLER_PASSWORD', $INSTALLER_PASSWORD) }}" required />
                </div>
                <div class="form-group col-md-6">
                    <label for="LICENSE_KEY">License Key</label>
                    <input name="LICENSE_KEY" id="LICENSE_KEY" class="form-control"
                        value="{{ old('LICENSE_KEY', $LICENSE_KEY ?? '') }}" required />
                </div>
            </div> --}}

            <hr />
            <div class="row g-3 m-0">
                <button class="btn btn-primary">Submit</button>
            </div>
            <br>

        </form>
    </main>

</body>

</html>
