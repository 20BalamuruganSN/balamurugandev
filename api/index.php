<?php
// index.php — redesigned responsive portfolio
$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($request_uri, PHP_URL_PATH) ?: '/';

// Serve static assets before rendering the page.
if (preg_match('/\.(jpg|jpeg|png|gif|webp|css|js|svg|ico)$/i', $path)) {
    $file_path = realpath(__DIR__ . '/../' . ltrim($path, '/'));
    $asset_root = realpath(__DIR__ . '/..');
    if ($file_path && $asset_root && str_starts_with($file_path, $asset_root . DIRECTORY_SEPARATOR) && is_file($file_path)) {
        $mime = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'svg' => 'image/svg+xml',
            'ico' => 'image/x-icon'
        ];
        $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        if (isset($mime[$ext]))
            header('Content-Type: ' . $mime[$ext]);
        readfile($file_path);
        exit;
    }
    http_response_code(404);
    exit('Asset not found');
}

require_once __DIR__ . '/../includes/header.php';
?>

<style>
    :root {
        --ink: #101828;
        --muted: #667085;
        --brand: #635bff;
        --brand2: #18b6a4;
        --line: #e8eaf2;
        --surface: #f7f8fc
    }

    html {
        scroll-behavior: smooth;
        scroll-padding-top: 90px
    }

    body {
        color: var(--ink);
        background: #fff
    }

    .portfolio {
        overflow: hidden
    }

    .p-wrap {
        width: min(1160px, calc(100% - 40px));
        margin-inline: auto
    }

    .p-kicker {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: var(--brand);
        font-size: .74rem;
        font-weight: 800;
        letter-spacing: .16em;
        text-transform: uppercase
    }

    .p-kicker:before {
        content: "";
        width: 24px;
        height: 2px;
        background: currentColor;
        border-radius: 4px
    }

    .p-title {
        font-size: clamp(2.1rem, 5vw, 3.7rem);
        line-height: 1.06;
        letter-spacing: -.055em;
        font-weight: 850
    }

    .p-gradient {
        background: linear-gradient(110deg, #635bff 10%, #14b8a6 90%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent
    }

    .p-muted {
        color: var(--muted)
    }

    .p-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 13px 21px;
        border-radius: 14px;
        font-weight: 750;
        font-size: .9rem;
        transition: transform .2s, box-shadow .2s, background .2s
    }

    .p-btn:hover {
        transform: translateY(-2px)
    }

    .p-btn-primary {
        color: #fff;
        background: linear-gradient(120deg, #635bff, #5148e8);
        box-shadow: 0 10px 25px #635bff30
    }

    .p-btn-light {
        background: #fff;
        border: 1px solid var(--line);
        color: #263044
    }

    .p-hero {
        position: relative;
        padding: 100px 0 84px;
        background: radial-gradient(ellipse at 75% 10%, #e7eaff 0, transparent 35%), radial-gradient(ellipse at 10% 85%, #e5fbf7 0, transparent 28%), #fbfcff
    }

    .p-hero:before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: linear-gradient(#e8eaf5 1px, transparent 1px), linear-gradient(90deg, #e8eaf5 1px, transparent 1px);
        background-size: 44px 44px;
        opacity: .28;
        mask-image: linear-gradient(to bottom, #000, transparent 90%);
        pointer-events: none
    }

    .p-hero-grid {
        position: relative;
        display: grid;
        grid-template-columns: 1.12fr .88fr;
        gap: 60px;
        align-items: center
    }

    .p-status {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 9px 13px;
        border: 1px solid #d9f4e8;
        background: #f0fdf7;
        color: #147d58;
        border-radius: 999px;
        font-size: .78rem;
        font-weight: 700
    }

    .p-status i {
        width: 7px;
        height: 7px;
        background: #20bf83;
        border-radius: 50%;
        box-shadow: 0 0 0 4px #20bf8320
    }

    .p-hero h1 {
        font-size: clamp(3rem, 6.6vw, 5.5rem);
        line-height: .99;
        letter-spacing: -.075em;
        font-weight: 900;
        margin: 25px 0
    }

    .p-hero-copy {
        max-width: 590px;
        color: #667085;
        font-size: 1.04rem;
        line-height: 1.85
    }

    .p-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 9px;
        margin-top: 25px
    }

    .p-tag {
        padding: 8px 12px;
        border: 1px solid #e4e7ef;
        background: #ffffffbd;
        border-radius: 10px;
        font-size: .78rem;
        font-weight: 650;
        color: #475467
    }

    .p-code-card {
        position: relative;
        padding: 13px;
        border: 1px solid #e7e9f3;
        background: #fff;
        border-radius: 26px;
        box-shadow: 0 30px 80px #293b781b;
        transform: rotate(1.5deg)
    }

    .p-code-inner {
        background: #111827;
        color: #e5e7eb;
        border-radius: 18px;
        padding: 25px;
        min-height: 330px
    }

    .p-windowbar {
        display: flex;
        align-items: center;
        gap: 6px;
        padding-bottom: 20px;
        border-bottom: 1px solid #ffffff14;
        margin-bottom: 22px
    }

    .p-dot {
        height: 9px;
        width: 9px;
        border-radius: 50%;
        background: #fb7185
    }

    .p-dot:nth-child(2) {
        background: #fbbf24
    }

    .p-dot:nth-child(3) {
        background: #34d399
    }

    .p-code-label {
        margin-left: auto;
        color: #64748b;
        font: 11px monospace
    }

    .p-code {
        font: clamp(.72rem, 1.2vw, .84rem)/2.1 ui-monospace, SFMono-Regular, Menlo, monospace
    }

    .p-code .pink {
        color: #f0abfc
    }

    .p-code .blue {
        color: #7dd3fc
    }

    .p-code .green {
        color: #86efac
    }

    .p-code .yellow {
        color: #fde68a
    }

    .p-float-chip {
        position: absolute;
        right: -18px;
        bottom: 28px;
        background: #fff;
        padding: 14px 17px;
        border-radius: 16px;
        box-shadow: 0 14px 35px #1018281a;
        border: 1px solid var(--line);
        font-size: .78rem;
        font-weight: 750
    }

    .p-float-chip b {
        color: var(--brand);
        font-size: 1.1rem
    }

    .p-marquee {
        overflow: hidden;
        border-block: 1px solid var(--line);
        background: #fff;
        padding: 18px 0
    }

    .p-marquee-track {
        display: flex;
        align-items: center;
        gap: 32px;
        width: max-content;
        animation: marquee 28s linear infinite
    }

    .p-marquee-track span {
        font-size: .76rem;
        font-weight: 800;
        letter-spacing: .12em;
        color: #98a2b3;
        white-space: nowrap
    }

    .p-marquee-track em {
        font-style: normal;
        color: #635bff
    }

    @keyframes marquee {
        to {
            transform: translateX(-50%)
        }
    }

    .p-section {
        padding: 92px 0
    }

    .p-about-grid {
        display: grid;
        grid-template-columns: .8fr 1.2fr;
        gap: 80px
    }

    .p-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-top: 28px
    }

    .p-stat {
        padding: 18px;
        border-radius: 17px;
        background: #f6f7ff;
        border: 1px solid #eceeff
    }

    .p-stat strong {
        display: block;
        font-size: 1.55rem;
        color: var(--brand);
        letter-spacing: -.04em
    }

    .p-stat span {
        font-size: .75rem;
        color: var(--muted)
    }

    .p-skill-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-top: 38px
    }

    .p-skill {
        padding: 24px;
        border: 1px solid var(--line);
        border-radius: 20px;
        background: #fff;
        transition: .25s
    }

    .p-skill:hover {
        transform: translateY(-5px);
        border-color: #c9c6ff;
        box-shadow: 0 18px 45px #635bff12
    }

    .p-skill-icon {
        display: grid;
        place-items: center;
        width: 43px;
        height: 43px;
        border-radius: 13px;
        background: #f0efff;
        color: var(--brand);
        font-size: 1.2rem;
        font-weight: 900;
        margin-bottom: 20px
    }

    .p-skill h3 {
        font-size: 1rem;
        font-weight: 800
    }

    .p-skill p {
        font-size: .83rem;
        line-height: 1.7;
        color: var(--muted);
        margin-top: 8px
    }

    .p-project {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 42px;
        align-items: center;
        padding: 30px;
        border: 1px solid var(--line);
        border-radius: 28px;
        background: linear-gradient(135deg, #fafbff, #f5f7ff);
        margin-top: 22px
    }

    .p-project:nth-of-type(even) {
        background: linear-gradient(135deg, #f5fffc, #f7fbff)
    }

    .p-project-copy {
        padding: 10px
    }

    .p-project-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: .75rem;
        color: #8b95a7;
        font-weight: 700
    }

    .p-project-number {
        background: #e9e8ff;
        color: #5b52ed;
        border-radius: 8px;
        padding: 6px 9px
    }

    .p-project h3 {
        font-size: 2rem;
        font-weight: 850;
        letter-spacing: -.04em;
        margin: 17px 0 10px
    }

    .p-project p {
        color: var(--muted);
        font-size: .9rem;
        line-height: 1.8
    }

    .p-project-shot {
        padding: 10px;
        background: #111827;
        border-radius: 20px;
        box-shadow: 0 20px 50px #17213a20;
        overflow: hidden
    }

    .p-project-shot img {
        width: 100%;
        height: auto;
        min-height: 220px;
        max-height: 390px;
        object-fit: cover;
        object-position: top;
        border-radius: 12px;
        display: block
    }

    .p-project-shot img[src=""] {
        display: none
    }

    .p-product {
        background: radial-gradient(ellipse at 15% 20%, #e9eaff, transparent 35%), #f8f9ff
    }

    .p-product-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
        margin-top: 55px
    }

    .p-crm-frame {
        padding: 13px;
        background: #fff;
        border: 1px solid #e3e7f2;
        border-radius: 24px;
        box-shadow: 0 28px 70px #243a7a18
    }

    .p-crm-frame img {
        width: 100%;
        display: block;
        border-radius: 14px
    }

    .p-feature {
        display: flex;
        gap: 13px;
        padding: 15px;
        border: 1px solid #e8eaf4;
        background: #ffffffc9;
        border-radius: 15px
    }

    .p-feature-icon {
        flex-shrink: 0;
        display: grid;
        place-items: center;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #eeedff;
        color: #6258f5;
        font-weight: 900
    }

    .p-feature strong {
        font-size: .88rem
    }

    .p-feature p {
        font-size: .78rem;
        color: var(--muted);
        margin-top: 4px
    }

    .p-contact {
        padding: 65px 25px;
        text-align: center;
        border-radius: 30px;
        background: linear-gradient(125deg, #111827, #20294a);
        color: #fff;
        position: relative;
        overflow: hidden
    }

    .p-contact:before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        background: #635bff55;
        filter: blur(70px);
        top: -150px;
        left: 15%
    }

    .p-contact>* {
        position: relative
    }

    .p-contact p {
        color: #b6bfd0;
        max-width: 550px;
        margin: 15px auto 0;
        line-height: 1.8
    }

    .p-contact-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
        margin-top: 28px
    }

    .p-contact .p-btn-light {
        background: #ffffff12;
        border-color: #ffffff30;
        color: #fff
    }

    @media(max-width:900px) {
        .p-hero-grid {
            grid-template-columns: 1fr;
            gap: 45px
        }

        .p-code-card {
            max-width: 520px;
            margin: auto
        }

        .p-about-grid {
            grid-template-columns: 1fr;
            gap: 25px
        }

        .p-skill-grid {
            grid-template-columns: repeat(2, 1fr)
        }

        .p-project,
        .p-product-grid {
            grid-template-columns: 1fr;
            gap: 25px
        }

        .p-project-shot {
            order: 0
        }

        .p-project-copy {
            order: 1
        }

        .p-project:nth-of-type(odd) .p-project-shot {
            order: 0
        }

        .p-project:nth-of-type(odd) .p-project-copy {
            order: 1
        }
    }

    @media(max-width:560px) {
        .p-wrap {
            width: min(100% - 28px, 1160px)
        }

        .p-hero {
            padding: 75px 0 60px
        }

        .p-hero h1 {
            font-size: clamp(2.7rem, 13vw, 4rem)
        }

        .p-section {
            padding: 65px 0
        }

        .p-skill-grid {
            gap: 10px
        }

        .p-skill {
            padding: 17px
        }

        .p-stats {
            gap: 8px
        }

        .p-stat {
            padding: 13px 10px
        }

        .p-stat strong {
            font-size: 1.25rem
        }

        .p-project {
            padding: 15px;
            border-radius: 22px
        }

        .p-project h3 {
            font-size: 1.65rem
        }

        .p-code-inner {
            padding: 18px;
            min-height: 280px
        }

        .p-float-chip {
            right: 0
        }

        .p-contact {
            padding: 48px 18px
        }
    }

    @media(prefers-reduced-motion:reduce) {

        *,
        *:before,
        *:after {
            animation: none !important;
            scroll-behavior: auto !important;
            transition: none !important
        }
    }
</style>

<main class="portfolio">
    <section id="home" class="p-hero">
        <div class="p-wrap p-hero-grid">
            <div>
                <div class="p-status"><i></i> Available for opportunities</div>
                <p class="p-kicker" style="margin-top:25px">Full Stack Engineer</p>
                <h1>Building <span class="p-gradient">digital products</span><br>that work.</h1>
                <p class="p-hero-copy">I'm Bala Murugan — a Full Stack Engineer and React Native Developer building
                    responsive web experiences, Android apps, and practical business software.</p>
                <div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:28px">
                    <a class="p-btn p-btn-primary" href="#projects">Explore projects <span>↗</span></a>
                    <button class="p-btn p-btn-light" type="button" onclick="openSubscriptionModal()">Let's talk
                        <span>→</span></button>
                </div>
                <div class="p-tags"><span class="p-tag">React Native</span><span class="p-tag">React.js</span><span
                        class="p-tag">PHP MVC</span><span class="p-tag">MySQL</span><span class="p-tag">REST APIs</span>
                </div>
            </div>
            <div class="p-code-card">
                <div class="p-code-inner">
                    <div class="p-windowbar"><i class="p-dot"></i><i class="p-dot"></i><i class="p-dot"></i><span
                            class="p-code-label">bala.dev / profile.js</span></div>
                    <div class="p-code">
                        <div><span class="pink">const</span> <span class="blue">developer</span> = <span
                                class="yellow">{</span></div>
                        <div style="padding-left:20px">name: <span class="green">"Bala Murugan"</span>,</div>
                        <div style="padding-left:20px">role: <span class="green">"Full Stack Engineer"</span>,</div>
                        <div style="padding-left:20px">mobile: <span class="green">"React Native + Expo"</span>,</div>
                        <div style="padding-left:20px">web: <span class="green">"React.js"</span>,</div>
                        <div style="padding-left:20px">backend: <span class="green">"PHP MVC"</span>,</div>
                        <div style="padding-left:20px">database: <span class="green">"MySQL"</span></div>
                        <div><span class="yellow">}</span>;</div>
                        <div style="margin-top:18px;color:#64748b">// Turning ideas into useful software ✨</div>
                    </div>
                </div>
                <div class="p-float-chip"><b>2.5+</b><br>Years building</div>
            </div>
        </div>
    </section>

    <div class="p-marquee" aria-label="Technology stack">
        <div class="p-marquee-track">
            <span>REACT NATIVE <em>✦</em></span><span>EXPO <em>✦</em></span><span>REACT.JS <em>✦</em></span><span>PHP
                MVC <em>✦</em></span><span>MYSQL <em>✦</em></span><span>REST API <em>✦</em></span>
            <span>REACT NATIVE <em>✦</em></span><span>EXPO <em>✦</em></span><span>REACT.JS <em>✦</em></span><span>PHP
                MVC <em>✦</em></span><span>MYSQL <em>✦</em></span><span>REST API <em>✦</em></span>
        </div>
    </div>

    <section id="about" class="p-section">
        <div class="p-wrap p-about-grid">
            <div>
                <p class="p-kicker">About me</p>
                <h2 class="p-title" style="margin-top:15px">Developer focused on <span class="p-gradient">useful
                        products.</span></h2>
            </div>
            <div>
                <p class="p-muted" style="font-size:1rem;line-height:1.9">I'm Bala Murugan, a Computer Science and
                    Engineering graduate from Annamalai University. I build web and Android applications with an
                    emphasis on clean interfaces, reliable API integration, and practical business workflows.</p>
                <p class="p-muted" style="font-size:1rem;line-height:1.9;margin-top:15px">My experience includes React
                    Native with Expo, React.js, PHP MVC, MySQL, and REST APIs. I enjoy translating business requirements
                    into simple, maintainable software.</p>
                <div class="p-stats">
                    <div class="p-stat"><strong>2.5+</strong><span>Years experience</span></div>
                    <div class="p-stat"><strong>Web</strong><span>Development</span></div>
                    <div class="p-stat"><strong>Android</strong><span>Applications</span></div>
                </div>
            </div>
        </div>
    </section>

    <section id="skills" class="p-section" style="background:var(--surface)">
        <div class="p-wrap">
            <div style="text-align:center">
                <p class="p-kicker">My toolkit</p>
                <h2 class="p-title" style="margin-top:15px">Technologies I work with</h2>
                <p class="p-muted" style="margin-top:12px">A practical stack for building and shipping products.</p>
            </div>
            <div class="p-skill-grid">
                <article class="p-skill">
                    <div class="p-skill-icon">R</div>
                    <h3>React Native</h3>
                    <p>Android app development with Expo and modern React Native workflows.</p>
                </article>
                <article class="p-skill">
                    <div class="p-skill-icon">⚛</div>
                    <h3>React.js</h3>
                    <p>Responsive web interfaces and interactive business applications.</p>
                </article>
                <article class="p-skill">
                    <div class="p-skill-icon">PHP</div>
                    <h3>PHP MVC</h3>
                    <p>Backend development, structured architecture, and API integration.</p>
                </article>
                <article class="p-skill">
                    <div class="p-skill-icon">DB</div>
                    <h3>MySQL</h3>
                    <p>Database design, SQL queries, and business data management.</p>
                </article>
            </div>
        </div>
    </section>

    <section id="projects" class="p-section">
        <div class="p-wrap">
            <p class="p-kicker">Selected work</p>
            <h2 class="p-title" style="margin-top:15px;max-width:700px">Projects built to solve <span
                    class="p-gradient">real problems.</span></h2>
            <article class="p-project">
                <div class="p-project-copy">
                    <div class="p-project-meta"><span class="p-project-number">01 / WEB</span><span>Live project</span>
                    </div>
                    <h3>RightHMS</h3>
                    <p>Hotel and restaurant management solution designed around day-to-day hospitality operations, with
                        a clean and professional product experience.</p>
                    <div class="p-tags"><span class="p-tag">Web</span><span class="p-tag">Responsive UI</span><span
                            class="p-tag">Hospitality</span></div><a class="p-btn p-btn-primary" style="margin-top:23px"
                        href="https://righthms.com" target="_blank" rel="noopener">Visit RightHMS ↗</a>
                </div>
                <div class="p-project-shot"><img src="/assets/img/cache/RightHMS.png" alt="RightHMS website screenshot"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='https://placehold.co/900x560/101827/ffffff?text=RightHMS+Preview'">
                </div>
            </article>
            <article class="p-project">
                <div class="p-project-shot"><img src="/assets/img/cache/Meddoz.png" alt="Meddoz website screenshot"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='https://placehold.co/900x560/102c27/ffffff?text=Meddoz+Preview'">
                </div>
                <div class="p-project-copy">
                    <div class="p-project-meta"><span class="p-project-number">02 / WEB</span><span>Live project</span>
                    </div>
                    <h3>Meddoz</h3>
                    <p>Pharmacy billing and management software website with a clear, accessible experience for
                        healthcare businesses.</p>
                    <div class="p-tags"><span class="p-tag">Web</span><span class="p-tag">Business software</span></div>
                    <a class="p-btn p-btn-primary" style="margin-top:23px" href="https://meddoz.com" target="_blank"
                        rel="noopener">Visit Meddoz ↗</a>
                </div>
            </article>
        </div>
    </section>

    <section id="product" class="p-section p-product">
        <div class="p-wrap">
            <div style="text-align:center"><span class="p-status">✦ Personal product</span>
                <h2 class="p-title" style="margin-top:20px">Work Smart <span class="p-gradient">CRM</span></h2>
                <p class="p-muted" style="max-width:650px;margin:15px auto 0;line-height:1.8">A simple CRM concept for
                    small and growing businesses to organize leads, customers, quotations, tasks, tickets, and daily
                    activities in one place.</p>
            </div>
            <div class="p-product-grid">
                <div class="p-crm-frame"><img src="/assets/img/cache/work_smart_crm.png"
                        alt="Work Smart CRM dashboard screenshot" loading="lazy"
                        onerror="this.onerror=null;this.src='https://placehold.co/900x620/172033/ffffff?text=Work+Smart+CRM+Dashboard'">
                </div>
                <div>
                    <h3 class="p-title" style="font-size:clamp(2rem,4vw,3.2rem)">Manage your business <span
                            class="p-gradient">smarter.</span></h3>
                    <p class="p-muted" style="line-height:1.8;margin-top:15px">Bring your team's important business
                        activities together in one organized workspace.</p>
                    <div style="display:grid;gap:12px;margin-top:25px">
                        <div class="p-feature"><span class="p-feature-icon">↗</span>
                            <div><strong>Lead management</strong>
                                <p>Track prospects and follow up with confidence.</p>
                            </div>
                        </div>
                        <div class="p-feature"><span class="p-feature-icon">◎</span>
                            <div><strong>Customer records</strong>
                                <p>Keep customer information easy to find.</p>
                            </div>
                        </div>
                        <div class="p-feature"><span class="p-feature-icon">✓</span>
                            <div><strong>Tasks & activities</strong>
                                <p>Stay on top of everyday business work.</p>
                            </div>
                        </div>
                    </div>
                    <button class="p-btn p-btn-primary" style="margin-top:25px" type="button"
                        onclick="openSubscriptionModal()">Enquire about CRM ↗</button>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="p-section">
        <div class="p-wrap">
            <div class="p-contact">
                <p class="p-kicker" style="color:#a5a0ff;justify-content:center">Let's work together</p>
                <h2 class="p-title" style="margin-top:17px">Have a project <span style="color:#8f9cff">in mind?</span>
                </h2>
                <p>I'm open to software development opportunities, freelance projects, and business application work.
                </p>
                <div class="p-contact-links"><a class="p-btn p-btn-primary"
                        href="mailto:snbalamurugan20@gmail.com">Email me ↗</a><a class="p-btn p-btn-light"
                        href="tel:+919384902854">Call me</a><button class="p-btn p-btn-light" type="button"
                        onclick="openSubscriptionModal()">WhatsApp / Enquiry</button></div>
                <div style="margin-top:25px;color:#9ca8bd;font-size:.85rem">snbalamurugan20@gmail.com&nbsp; · &nbsp;+91
                    93849 02854</div>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>