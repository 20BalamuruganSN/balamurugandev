<?php
// includes/header.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bala Murugan - Full Stack Engineer, React Native Developer and React Developer.">
    <title>Bala Murugan | Full Stack Engineer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { poppins: ["Poppins", "sans-serif"] },
                    colors: { primary: "#0f6fff", skyblue: "#38bdf8", dark: "#0f172a", soft: "#f5f9ff", whatsapp: "#25D366" },
                    boxShadow: { soft: "0 20px 60px rgba(15, 111, 255, 0.10)", blue: "0 20px 60px rgba(15, 111, 255, 0.20)" }
                }
            }
        }
    </script>
    <style>
        * { scroll-behavior: smooth; }
        body { font-family: "Poppins", sans-serif; background: #ffffff; color: #0f172a; overflow-x: hidden; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #38bdf8; border-radius: 20px; }
        
        .navbar { transition: all .3s ease; }
        .navbar.scrolled { background: rgba(255,255,255,.92); backdrop-filter: blur(18px); box-shadow: 0 10px 40px rgba(15,23,42,.08); }
        .gradient-text { background: linear-gradient(90deg, #0f6fff, #38bdf8); -webkit-background-clip: text; background-clip: text; color: transparent; }
        
        .hero-glow { position: absolute; width: 450px; height: 450px; border-radius: 50%; background: radial-gradient(circle, rgba(56,189,248,.18), transparent 70%); filter: blur(20px); pointer-events: none; }
        .grid-bg { background-image: linear-gradient(rgba(15,111,255,.045) 1px, transparent 1px), linear-gradient(90deg, rgba(15,111,255,.045) 1px, transparent 1px); background-size: 45px 45px; }
        
        .marquee { overflow: hidden; white-space: nowrap; }
        .marquee-track { display: inline-flex; min-width: max-content; animation: marquee 25s linear infinite; }
        .marquee:hover .marquee-track { animation-play-state: paused; }
        @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        
        .reveal { opacity: 0; transform: translateY(35px); transition: opacity .8s ease, transform .8s ease; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        
        .project-showcase { transition: transform .45s ease, box-shadow .45s ease, border-color .45s ease; }
        .project-showcase:hover { transform: translateY(-10px); box-shadow: 0 30px 80px rgba(15,111,255,.14); border-color: rgba(56,189,248,.6); }
        .project-window { transition: transform .5s ease; }
        .project-showcase:hover .project-window { transform: scale(1.025) rotateX(2deg) rotateY(-2deg); }
        
        .btn-primary { transition: transform .25s ease, box-shadow .25s ease; }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(15,111,255,.25); }
        
        .skill-card { transition: transform .3s ease, border-color .3s ease, box-shadow .3s ease; }
        .skill-card:hover { transform: translateY(-7px); border-color: rgba(56,189,248,.6); box-shadow: 0 20px 50px rgba(15,111,255,.09); }
        
        .review-slider { overflow: hidden; width: 100%; }
        .review-track { display: flex; width: max-content; animation: reviewMove 35s linear infinite; }
        .review-track:hover { animation-play-state: paused; }
        @keyframes reviewMove { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        .review-card { width: 390px; margin-right: 20px; flex-shrink: 0; transition: transform .3s ease; }
        .review-card:hover { transform: translateY(-8px); }
        
        .product-section { background: radial-gradient(circle at 10% 10%, rgba(56,189,248,.16), transparent 35%), radial-gradient(circle at 90% 80%, rgba(15,111,255,.14), transparent 35%), #f8fbff; }
        
        .float { animation: float 4s ease-in-out infinite; }
        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
        
        ::selection { background: #38bdf8; color: white; }
        
        .whatsapp-float { position: fixed; bottom: 30px; right: 30px; z-index: 999; width: 60px; height: 60px; background: #25D366; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.8rem; box-shadow: 0 10px 30px rgba(37, 211, 102, 0.4); transition: all 0.3s ease; animation: pulse-whatsapp 2s infinite; }
        .whatsapp-float:hover { transform: scale(1.1); box-shadow: 0 15px 40px rgba(37, 211, 102, 0.5); }
        @keyframes pulse-whatsapp { 0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5); } 70% { box-shadow: 0 0 0 20px rgba(37, 211, 102, 0); } 100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); } }

        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.6); z-index: 9999; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: all 0.3s ease; backdrop-filter: blur(5px); }
        .modal-overlay.active { opacity: 1; visibility: visible; }
        .modal-content { background: white; border-radius: 20px; padding: 40px; max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto; transform: scale(0.9); transition: transform 0.3s ease; position: relative; }
        .modal-overlay.active .modal-content { transform: scale(1); }
        
        .form-input { width: 100%; padding: 14px 16px; border: 1px solid #e2e8f0; border-radius: 10px; font-family: 'Poppins', sans-serif; font-size: 14px; transition: border-color 0.3s; margin-bottom: 15px; background: #f8fafc; }
        .form-input:focus { outline: none; border-color: #0f6fff; background: white; }
        
        .radio-group { display: flex; flex-direction: column; gap: 10px; margin: 15px 0; }
        .radio-option { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; cursor: pointer; transition: all 0.3s; }
        .radio-option:hover { border-color: #0f6fff; background: #f5f9ff; }
        .radio-option input[type="radio"] { accent-color: #0f6fff; }
        
        .plan-price { background: linear-gradient(135deg, #0f6fff, #38bdf8); color: white; padding: 15px; border-radius: 12px; text-align: center; margin: 20px 0; }
        .plan-price h3 { font-size: 2rem; margin: 0; font-weight: 800; }
        .plan-price p { margin: 5px 0 0; opacity: 0.9; font-size: 14px; }
        
        .btn-submit { width: 100%; padding: 16px; background: linear-gradient(135deg, #0f6fff, #38bdf8); color: white; border: none; border-radius: 10px; font-weight: 700; font-size: 16px; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(15,111,255,0.3); }
        
        .btn-close { position: absolute; top: 15px; right: 15px; background: none; border: none; font-size: 24px; cursor: pointer; color: #64748b; transition: color 0.3s; }
        .btn-close:hover { color: #ef4444; }
        
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        .fa-spin { animation: spin 1s linear infinite; }
        
        .notification { position: fixed; top: 20px; right: 20px; padding: 15px 25px; border-radius: 10px; color: white; font-weight: 500; z-index: 10000; transform: translateX(150%); transition: transform 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .notification.show { transform: translateX(0); }
        .notification.success { background: #10b981; }
        .notification.error { background: #ef4444; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<header id="navbar" class="navbar fixed left-0 top-0 z-50 w-full bg-white/70">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
        <a href="/" class="text-xl font-extrabold tracking-tight">Bala<span class="text-primary">.</span></a>
        <nav class="hidden items-center gap-8 md:flex">
            <a href="#home" class="text-sm font-medium text-slate-600 transition hover:text-primary">Home</a>
            <a href="#about" class="text-sm font-medium text-slate-600 transition hover:text-primary">About</a>
            <a href="#skills" class="text-sm font-medium text-slate-600 transition hover:text-primary">Skills</a>
            <a href="#projects" class="text-sm font-medium text-slate-600 transition hover:text-primary">Projects</a>
            <a href="#product" class="text-sm font-medium text-slate-600 transition hover:text-primary">My Product</a>
            <a href="#reviews" class="text-sm font-medium text-slate-600 transition hover:text-primary">Reviews</a>
            <a href="#contact" class="rounded-full bg-primary px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">Contact</a>
        </nav>
        <button id="menuButton" class="rounded-lg border border-slate-200 p-2 md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>
    <div id="mobileMenu" class="hidden border-t bg-white px-5 py-5 md:hidden">
        <div class="flex flex-col gap-4 font-medium text-slate-600">
            <a href="#home">Home</a><a href="#about">About</a><a href="#skills">Skills</a><a href="#projects">Projects</a><a href="#product">My Product</a><a href="#reviews">Reviews</a><a href="#contact">Contact</a>
        </div>
    </div>
</header>