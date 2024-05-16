<h3 class="secondary-font top-space">فرم تماس با ما</h3>
<form action="{{ route('contact-us.message') }}" method="post" role="form">
    @csrf
    @honeypot
    @if(session()->has('errors'))
        <div class="alert alert-danger">
            <strong>خطا!</strong>
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="error-container"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>نام</label>
                <input class="form-control form-control-name" name="name" id="name" placeholder="" type="text" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>موضوع</label>
                <input class="form-control form-control-subject" name="subject" id="subject" placeholder="" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>ایمیل</label>
                <input class="form-control form-control-email" name="email" id="email" placeholder="" type="email" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>شماره تماس (دلخواه)</label>
                <input class="form-control form-control-phone" name="phone" id="phone" placeholder="" type="phone" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>پیام</label>
        <textarea class="form-control form-control-message" name="message" id="message" placeholder="" rows="10" required></textarea>
    </div>
    <div class="text-right"><br>
        <button class="btn btn-primary solid blank" type="submit">ارسال پیام</button>
    </div>
</form>
