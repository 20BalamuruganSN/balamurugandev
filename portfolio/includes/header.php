<?php
require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Bala Murugan - Full Stack Engineer. CRM subscription ₹1,500/month, website & Android development." />
  <title>Bala Murugan | Full Stack Engineer</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    tailwind.config = {
      theme: { extend: {
        fontFamily: { poppins: ['Poppins','sans-serif'] },
        colors: { primary:'#0f6fff', skyblue:'#38bdf8', dark:'#0f172a', soft:'#f5f9ff' },
        boxShadow: {
          soft: '0 20px 60px rgba(15,111,255,.10)',
          blue: '0 20px 60px rgba(15,111,255,.20)'
        }
      }}
    }
  </script>

  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="font-poppins bg-white text-slate-900 overflow-x-hidden">

<!-- NAVBAR -->
<header id="navbar" class="navbar fixed left-0 top-0 z-50 w-full bg-white/70">
  <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
    <a href="#home" class="text-xl font-extrabold tracking-tight">Bala<span class="text-primary">.</span></a>

    <nav class="hidden items-center gap-8 md:flex">
      <a href="#home"     class="text-sm font-medium text-slate-600 transition hover:text-primary">Home</a>
      <a href="#about"    class="text-sm font-medium text-slate-600 transition hover:text-primary">About</a>
      <a href="#skills"   class="text-sm font-medium text-slate-600 transition hover:text-primary">Skills</a>
      <a href="#projects" class="text-sm font-medium text-slate-600 transition hover:text-primary">Projects</a>
      <a href="#services" class="text-sm font-medium text-slate-600 transition hover:text-primary">Services</a>
      <a href="#product"  class="text-sm font-medium text-slate-600 transition hover:text-primary">CRM</a>
      <a href="#contact"  class="rounded-full bg-primary px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">Contact</a>
    </nav>

    <button id="menuButton" class="rounded-lg border border-slate-200 p-2 md:hidden">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
  </div>

  <div id="mobileMenu" class="hidden border-t bg-white px-5 py-5 md:hidden">
    <div class="flex flex-col gap-4">
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#skills">Skills</a>
      <a href="#projects">Projects</a>
      <a href="#services">Services</a>
      <a href="#product">CRM</a>
      <a href="#contact">Contact</a>
    </div>
  </div>
</header>