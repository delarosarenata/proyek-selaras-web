@extends('layouts.app')

@section('content')

<style>
  :root{
    --bg-1:#f5efe6;
    --bg-2:#e6d9c3;
    --card:#ffffffcc;         /* semi transparan buat efek glass */
    --text:#1f2937;
    --muted:#6b7280;
    --ring:#6366f1;           /* indigo */
    --btn:#2563eb;            /* primary */
    --btn-hover:#1d4ed8;
  }

  /* full height center */
  /* main{ min-height: calc(100vh - 110px); display:flex; align-items:center; } */
  body{ background: linear-gradient(160deg,var(--bg-1),var(--bg-2)); }

  /* wrapper biar gak terlalu mepet */
  .auth-wrap{ width:100%; max-width:720px; margin-inline:auto; padding:1rem; }

  /* card glassy */
  .auth-card{
    background: var(--card);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,.4);
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
    overflow:hidden;
  }

  .auth-card .card-header{
    background: transparent;
    border-bottom:none;
    padding: 1.25rem 1.5rem 0 1.5rem;
  }

  .auth-title{
    font-weight:700; color:var(--text); letter-spacing:.3px;
    display:flex; align-items:center; gap:.5rem;
  }
  .auth-title .dot{
    width:10px; height:10px; border-radius:999px; background:var(--ring);
    box-shadow:0 0 0 4px rgba(99,102,241,.18);
  }

  .auth-card .card-body{ padding: 1.25rem 1.5rem 1.75rem; }

  /* input styling */
  .form-control{
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    padding:.65rem .9rem;
    transition: box-shadow .2s, border-color .2s, transform .05s;
    background: #fff;
  }
  .form-control:focus{
    border-color: var(--ring);
    box-shadow: 0 0 0 .25rem rgba(99,102,241,.18);
  }
  .is-invalid{ border-color:#ef4444 !important; }

  /* labels */
  .col-form-label{ color:#374151; font-weight:600; }

  /* helper line */
  .helper{
    color:var(--muted); font-size:.915rem;
    padding-left:.25rem;
  }

  /* button */
  .btn-primary{
    background: var(--btn); border-color: var(--btn);
    border-radius: 12px; padding:.6rem 1.1rem; font-weight:600;
    transition: transform .05s ease, box-shadow .2s ease, background .2s ease;
    box-shadow: 0 10px 20px rgba(37,99,235,.18);
  }
  .btn-primary:hover{ background: var(--btn-hover); border-color:var(--btn-hover); }
  .btn-primary:active{ transform: translateY(1px); }

  /* small: rapikan spacing di mobile */
  @media (max-width: 576px){
    .col-form-label{ text-align:left !important; margin-bottom:.35rem; }
  }

  /* link opsional (lupa password dsb) */
  .text-link{ color:var(--ring); text-decoration:none; font-weight:600; }
  .text-link:hover{ text-decoration:underline; }
</style>

<div class="auth-wrap">
  <div class="card auth-card">
    <div class="card-header">
      <h5 class="auth-title">
        <span class="dot"></span>
        {{ __('Login') }}
      </h5>
    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row mb-3 align-items-center">
          <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
          <div class="col-md-8">
            <input id="username" type="text"
                   class="form-control @error('username') is-invalid @enderror"
                   name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
            @error('username')
              <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
          </div>
        </div>

        <div class="row mb-3 align-items-center">
          <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
          <div class="col-md-8">
            <div class="input-group">
              <input id="password" type="password"
                     class="form-control @error('password') is-invalid @enderror"
                     name="password" required autocomplete="current-password">
              <button class="btn btn-outline-secondary" type="button" id="togglePwd" style="border-radius:12px; border-left:0;">
                👁
              </button>
              @error('password')
                <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
              @enderror
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-8 offset-md-4 helper">
            Hubungi Admin apabila terdapat kendala dalam login.
          </div>
        </div>

        <div class="row mb-0">
          <div class="col-md-8 offset-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
            {{-- contoh link opsional --}}
            {{-- <a href="{{ route('password.request') }}" class="text-link">Lupa Password?</a> --}}
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // toggle show/hide password (tanpa lib tambahan)
  document.getElementById('togglePwd')?.addEventListener('click', function(){
    const i = document.getElementById('password');
    i.type = i.type === 'password' ? 'text' : 'password';
    this.textContent = i.type === 'password' ? '👁' : '🙈';
    i.focus();
  });
</script>
@endsection
