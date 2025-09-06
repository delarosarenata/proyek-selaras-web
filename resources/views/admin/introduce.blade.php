@extends('layouts.app')

@section('title', 'Kuesioner SELARAS')

@section('content')
<style>
  :root{
    --bg-krem:#f3e2c7;
    --ink:#0f172a;
    --muted:#6b7280;
    --primary:#2563eb;
    --primary-dark:#1d4ed8;
    --ring:rgba(37,99,235,.35);
  }
  body{ background:var(--bg-krem); }

  /* wrapper */
  /* .intro-section{ padding:72px 0 40px; } */
  /* @media (min-width:992px){ .intro-section{ padding-top:96px; } } */

  /* card */
  .intro-card{
    background:#fff;
    border-radius:28px;
    box-shadow:0 14px 40px rgba(0,0,0,.12);
    max-width:1140px;
    margin-inline:auto;
  }
  .intro-card .inner{ padding:48px 28px; }
  @media (min-width:992px){ .intro-card .inner{ padding:56px 64px; } }

  /* heading */
  .intro-title{
    color:var(--ink);
    font-weight:800;
    letter-spacing:.2px;
    font-size:clamp(1.9rem, 2.4vw + 1.4rem, 3.1rem);
  }
  .intro-sub{
    color:var(--muted);
    font-size:clamp(1rem, .6vw + .9rem, 1.25rem);
    margin-top:.25rem;
  }

  /* divider */
  .intro-rule{
    height:1px;
    background:linear-gradient(90deg, #0000, #e5e7eb, #0000);
    margin:22px auto 28px;
    max-width:980px;
  }

  /* body text */
  .lead-wrap{ max-width:980px; margin:0 auto 28px; }
  .lead{
    color:#374151;
    font-size:clamp(1.05rem, .5vw + .95rem, 1.35rem);
    line-height:1.9;
  }

  /* button */
  .cta{
    background:var(--primary);
    border:none;
    padding:18px 28px;
    font-size:clamp(1.05rem, .5vw + .95rem, 1.25rem);
    font-weight:700;
    border-radius:14px;
    transition:.2s ease;
    box-shadow:0 8px 20px var(--ring);
  }
  .cta:hover{ background:var(--primary-dark); transform:translateY(-1px); }
  .cta:active{ transform:none; box-shadow:0 4px 12px var(--ring); }

  /* footer text in card */
  .support{
    color:var(--muted);
    font-size:clamp(.95rem, .3vw + .85rem, 1.05rem);
  }
</style>

<section class="intro-section">
  <div class="container">
    <div class="intro-card">
      <div class="inner text-center">
        <h1 class="intro-title">Kuesioner Penilaian Pelayanan dan Respon Statistik</h1>
        <div class="intro-sub">BPS Kabupaten Pinrang</div>

        <div class="intro-rule"></div>

        <div class="lead-wrap">
          <p class="lead mb-3">
            Selamat datang di <strong>Sistem Pemantauan Penilaian Pelayanan Statistik Terpadu (SELARAS)</strong> BPS Kabupaten Pinrang.
            Survei ini digunakan untuk mengukur tingkat kepuasan, kebutuhan, dan respon pengguna layanan terhadap layanan statistik yang telah diberikan.
          </p>
        </div>

        <a href="{{ route('kuesioner.form') }}" target="_blank" class="btn btn-primary cta">
          Buka Kuesioner dan Bagikan kepada Responden
        </a>

        <!-- <div class="intro-rule mt-5"></div> -->

        <!-- <p class="support mb-0">Supported by <strong>SIPAKARAJA</strong></p> -->
      </div>
    </div>
  </div>
</section>
@endsection
