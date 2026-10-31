<?php
require_once __DIR__ . '/../includes/functions.php';

$projects = [
    [
        'id' => '01',
        'type' => 'WEB',
        'name' => 'RightHMS',
        'url' => 'https://righthms.com',
        'desc' => 'Hospital management solution website with a clean and professional interface designed for healthcare business operations.',
        'tags' => ['Web', 'Responsive', 'Business'],
        'status' => 'Live Project',
        'color' => 'blue'
    ],
    [
        'id' => '02',
        'type' => 'WEB',
        'name' => 'Meddoz',
        'url' => 'https://meddoz.com',
        'desc' => 'Pharmacy billing and management software website designed to provide a clear and simple business experience.',
        'tags' => ['Pharmacy', 'Web', 'Business'],
        'status' => 'Live Project',
        'color' => 'green'
    ],
    [
        'id' => '03',
        'type' => 'WEB',
        'name' => 'Sri Ganesh Foods',
        'url' => 'https://sriganeshfoods.in',
        'desc' => 'Responsive business website created for an industrial catering and food services client.',
        'tags' => ['Food', 'Catering', 'Responsive'],
        'status' => 'Completed',
        'color' => 'orange'
    ],
    [
        'id' => '04',
        'type' => 'WEB',
        'name' => 'ASkeyCRM',
        'url' => 'https://balamurugandev.vercel.app',
        'desc' => 'CRM & business management application for customers, leads and daily activities.',
        'tags' => ['CRM', 'Web App', 'Business'],
        'status' => 'Live Project',
        'color' => 'indigo'
    ],
    [
        'id' => '05',
        'type' => 'MOBILE',
        'name' => 'ASkeyRetail',
        'url' => 'https://balamurugandev.vercel.app',
        'desc' => 'Retail business mobile application built with React Native and Expo for business workflows.',
        'tags' => ['React Native', 'Expo', 'Android'],
        'status' => 'Live Project',
        'color' => 'cyan'
    ],
    [
        'id' => '06',
        'type' => 'MOBILE',
        'name' => 'RightKOT',
        'url' => 'https://balamurugandev.vercel.app',
        'desc' => 'Kitchen order management mobile app for restaurants and hotels.',
        'tags' => ['React Native', 'Expo', 'API'],
        'status' => 'Live Project',
        'color' => 'purple'
    ],
    [
        'id' => '07',
        'type' => 'WEB',
        'name' => 'SmartSteno',
        'url' => 'https://smartsteno.azurewebsites.net',
        'desc' => 'Online shorthand learning and typing practice platform designed for students and learners.',
        'tags' => ['Learning', 'Typing', 'Web'],
        'status' => 'Live Project',
        'color' => 'sky'
    ],
    [
        'id' => '08',
        'type' => 'MOBILE',
        'name' => 'Infuex',
        'url' => 'https://balamurugandev.vercel.app',
        'desc' => 'React Native app with wallet, chat, onboarding and API-based application features.',
        'tags' => ['React Native', 'REST API', 'WebSocket'],
        'status' => 'Completed',
        'color' => 'pink'
    ],
];

include __DIR__ . '/includes/header.php';
?>

<!-- ═══════════════════ HERO ═══════════════════ -->
<section id="home" class="grid-bg relative flex min-h-screen items-center overflow-hidden pt-24">
    <div class="hero-glow left-[-150px] top-[100px]"></div>
    <div class="hero-glow bottom-[-150px] right-[-100px]"></div>

    <div class="mx-auto grid max-w-7xl items-center gap-14 px-5 py-20 lg:grid-cols-[1.2fr_.8fr] lg:px-8">
        <div class="reveal">
            <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-sky-200 bg-sky-50 px-4 py-2">
                <span class="h-2 w-2 animate-pulse rounded-full bg-green-500"></span>
                <span class="text-xs font-semibold text-slate-600">Available for new opportunities</span>
            </div>

            <p class="text-sm font-bold uppercase tracking-[.3em] text-primary">Full Stack Engineer</p>

            <h1
                class="mt-5 max-w-4xl text-5xl font-extrabold leading-[1.08] tracking-tight text-slate-900 sm:text-6xl lg:text-7xl">
                Building <span class="gradient-text">modern digital</span> experiences.
            </h1>

            <p class="mt-7 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
                I'm Bala Murugan, a Full Stack Engineer focused on React Native, Expo, React.js
                and business applications. I build clean, responsive and practical digital
                products for real-world business needs.
            </p>

            <div class="mt-9 flex flex-wrap gap-4">
                <a href="#projects"
                    class="btn-primary rounded-full bg-primary px-7 py-3.5 text-sm font-bold text-white">
                    Explore My Work →
                </a>
                <button onclick="openLeadForm('website')"
                    class="rounded-full border border-slate-300 bg-white px-7 py-3.5 text-sm font-bold text-slate-700 transition hover:border-primary hover:text-primary">
                    Start a Project
                </button>
            </div>

            <div class="mt-10 flex flex-wrap gap-6 text-sm text-slate-500">
                <span>✓ React Native</span>
                <span>✓ React.js</span>
                <span>✓ PHP MVC</span>
                <span>✓ MySQL</span>
            </div>
        </div>

        <div class="reveal relative">
            <div class="float rounded-[2rem] border border-sky-100 bg-white p-5 shadow-blue">
                <div class="rounded-[1.5rem] bg-slate-950 p-5 text-white">
                    <div class="mb-5 flex items-center gap-2">
                        <span class="h-3 w-3 rounded-full bg-red-400"></span>
                        <span class="h-3 w-3 rounded-full bg-yellow-400"></span>
                        <span class="h-3 w-3 rounded-full bg-green-400"></span>
                        <span class="ml-auto text-[10px] text-slate-500">bala.dev</span>
                    </div>
                    <div class="space-y-3 font-mono text-xs leading-6">
                        <div><span class="text-pink-400">const</span> <span class="text-sky-300">developer</span> =
                            <span class="text-yellow-300">{</span>
                        </div>
                        <div class="pl-5">name: <span class="text-green-300">"Bala Murugan"</span>,</div>
                        <div class="pl-5">role: <span class="text-green-300">"Full Stack Engineer"</span>,</div>
                        <div class="pl-5">mobile: <span class="text-green-300">"React Native"</span>,</div>
                        <div class="pl-5">web: <span class="text-green-300">"React.js"</span>,</div>
                        <div class="pl-5">backend: <span class="text-green-300">"PHP MVC"</span></div>
                        <div><span class="text-yellow-300">}</span>;</div>
                    </div>
                </div>
            </div>

            <div
                class="absolute -bottom-6 -left-6 hidden rounded-2xl border border-sky-100 bg-white p-4 shadow-soft sm:block">
                <p class="text-xs text-slate-400">Experience</p>
                <p class="mt-1 text-xl font-extrabold text-primary">2+ Years</p>
            </div>

            <div
                class="absolute -right-5 -top-5 hidden rounded-2xl border border-sky-100 bg-white p-4 shadow-soft sm:block">
                <p class="text-xs text-slate-400">Focus</p>
                <p class="mt-1 text-sm font-bold text-slate-800">Web + Mobile</p>
            </div>
        </div>
    </div>
</section>

<!-- MARQUEE -->
<div class="marquee border-y border-slate-100 bg-slate-50 py-5">
    <div class="marquee-track">
        <?php foreach (['REACT NATIVE', 'EXPO CLI', 'REACT.JS', 'PHP MVC', 'MYSQL', 'REST API', 'REACT NATIVE', 'EXPO CLI', 'REACT.JS', 'PHP MVC', 'MYSQL', 'REST API'] as $i => $word): ?>
            <span class="mx-8 text-sm font-semibold text-slate-500"><?= $word ?></span>
            <?php if ($i % 6 !== 5): ?><span class="text-sky-400">✦</span><?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<!-- ═══════════════════ ABOUT ═══════════════════ -->
<section id="about" class="bg-white py-24 lg:py-32">
    <div class="mx-auto grid max-w-7xl gap-14 px-5 lg:grid-cols-2 lg:px-8">
        <div class="reveal">
            <p class="text-xs font-bold uppercase tracking-[.25em] text-primary">About Me</p>
            <h2 class="mt-3 text-4xl font-extrabold tracking-tight sm:text-5xl">
                Developer focused on <span class="gradient-text">useful products.</span>
            </h2>
        </div>
        <div class="reveal">
            <p class="text-base leading-8 text-slate-600">
                I'm Bala Murugan, a B.E. Computer Science and Engineering graduate from Annamalai University.
                I work on web and mobile applications with a focus on clean interfaces, API integration
                and practical business solutions.
            </p>
            <p class="mt-5 text-base leading-8 text-slate-600">
                My experience includes React Native with Expo, React.js, PHP MVC, MySQL and REST APIs.
                I enjoy turning business requirements into simple and maintainable software.
            </p>
            <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3">
                <div class="rounded-2xl bg-soft p-5">
                    <p class="text-2xl font-extrabold text-primary">2+</p>
                    <p class="mt-1 text-xs text-slate-500">Years Experience</p>
                </div>
                <div class="rounded-2xl bg-soft p-5">
                    <p class="text-2xl font-extrabold text-primary">Web</p>
                    <p class="mt-1 text-xs text-slate-500">Development</p>
                </div>
                <div class="rounded-2xl bg-soft p-5">
                    <p class="text-2xl font-extrabold text-primary">Mobile</p>
                    <p class="mt-1 text-xs text-slate-500">Development</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════ SKILLS ═══════════════════ -->
<section id="skills" class="bg-slate-50 py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="reveal text-center">
            <p class="text-xs font-bold uppercase tracking-[.25em] text-primary">Technologies</p>
            <h2 class="mt-3 text-4xl font-extrabold sm:text-5xl">Tools I work with</h2>
        </div>

        <div class="mt-14 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <?php
            $skills = [
                ['React Native', 'Cross-platform mobile app development with Expo.'],
                ['React.js', 'Modern responsive web interfaces and business apps.'],
                ['PHP MVC', 'Backend development using MVC architecture and APIs.'],
                ['MySQL', 'Database design, queries and business data management.'],
                ['REST APIs', 'API integration and communication between apps.'],
                ['JavaScript', 'ES6+, asynchronous programming and app logic.'],
                ['Git & GitHub', 'Version control and collaborative workflows.'],
                ['Bootstrap / Tailwind', 'Responsive and modern UI development.'],
            ];
            foreach ($skills as $s): ?>
                <div class="skill-card rounded-2xl border border-slate-200 bg-white p-6">
                    <p class="text-lg font-bold"><?= $s[0] ?></p>
                    <p class="mt-2 text-sm leading-6 text-slate-500"><?= $s[1] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════ PROJECTS ═══════════════════ -->
<section id="projects" class="bg-white py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="reveal mb-16 max-w-3xl">
            <p class="text-xs font-bold uppercase tracking-[.25em] text-primary">Selected Projects</p>
            <h2 class="mt-3 text-4xl font-extrabold tracking-tight sm:text-5xl">
                Work that solves <span class="gradient-text">real problems.</span>
            </h2>
            <p class="mt-5 text-sm leading-7 text-slate-500">
                Live previews pulled directly from each project's URL.
            </p>
        </div>

        <?php foreach ($projects as $p): ?>
            <article
                class="project-showcase reveal mb-10 overflow-hidden rounded-[2rem] border border-slate-200 bg-slate-50">
                <div class="grid items-center gap-10 p-6 md:p-10 lg:grid-cols-2">
                    <div>
                        <div class="flex items-center gap-3">
                            <span
                                class="rounded-full bg-<?= $p['color'] ?>-100 px-3 py-1 text-xs font-bold text-<?= $p['color'] ?>-700">
                                <?= $p['id'] ?> / <?= $p['type'] ?>
                            </span>
                            <span class="text-xs text-slate-400"><?= $p['status'] ?></span>
                        </div>

                        <h3 class="mt-5 text-3xl font-extrabold"><?= htmlspecialchars($p['name']) ?></h3>
                        <p class="mt-4 text-sm leading-7 text-slate-600"><?= htmlspecialchars($p['desc']) ?></p>

                        <div class="mt-6 flex flex-wrap gap-2">
                            <?php foreach ($p['tags'] as $t): ?>
                                <span class="rounded-full bg-white px-3 py-1 text-xs"><?= htmlspecialchars($t) ?></span>
                            <?php endforeach; ?>
                        </div>

                        <a href="<?= htmlspecialchars($p['url']) ?>" target="_blank" rel="noopener"
                            class="btn-primary mt-7 inline-flex rounded-full bg-primary px-6 py-3 text-sm font-bold text-white">
                            Visit <?= htmlspecialchars($p['name']) ?> ↗
                        </a>
                    </div>

                    <div class="project-window rounded-2xl bg-slate-900 p-3 shadow-blue">
                        <div class="overflow-hidden rounded-xl bg-white">
                            <div class="flex items-center gap-1.5 border-b border-slate-100 px-3 py-2">
                                <span class="h-2.5 w-2.5 rounded-full bg-red-400"></span>
                                <span class="h-2.5 w-2.5 rounded-full bg-yellow-400"></span>
                                <span class="h-2.5 w-2.5 rounded-full bg-green-400"></span>
                                <span
                                    class="ml-2 truncate text-[10px] text-slate-400"><?= htmlspecialchars($p['url']) ?></span>
                            </div>
                            <img src="<?= screenshot_url($p['url']) ?>" alt="<?= htmlspecialchars($p['name']) ?> screenshot"
                                loading="lazy" class="aspect-[3/2] w-full object-cover object-top">
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<!-- ═══════════════════ SERVICES ═══════════════════ -->
<section id="services" class="bg-slate-50 py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="reveal text-center">
            <p class="text-xs font-bold uppercase tracking-[.25em] text-primary">Services & Pricing</p>
            <h2 class="mt-3 text-4xl font-extrabold sm:text-5xl">Choose your package</h2>
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-500">
                Transparent pricing. Instant enquiry via email + WhatsApp.
            </p>
        </div>

        <div class="mt-14 grid gap-6 md:grid-cols-3">
            <div class="relative rounded-3xl border-2 border-primary bg-white p-8 shadow-blue">
                <span
                    class="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full bg-primary px-4 py-1 text-[10px] font-bold text-white">
                    MOST POPULAR
                </span>
                <p class="text-xs font-bold uppercase text-primary">CRM Subscription</p>
                <h3 class="mt-2 text-2xl font-extrabold">Work Smart CRM</h3>
                <div class="mt-5 flex items-baseline gap-1">
                    <span class="text-4xl font-extrabold text-primary">₹1,500</span>
                    <span class="text-sm text-slate-500">/ month</span>
                </div>
                <ul class="mt-6 space-y-2.5 text-sm text-slate-600">
                    <li>✓ Lead Management</li>
                    <li>✓ Customer Management</li>
                    <li>✓ Products & Services</li>
                    <li>✓ Quotations</li>
                    <li>✓ Tasks & Tickets</li>
                    <li>✓ Reports</li>
                </ul>
                <button onclick="openLeadForm('crm')"
                    class="btn-primary mt-7 w-full rounded-xl bg-primary py-3 text-sm font-bold text-white">
                    Subscribe Now
                </button>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-8">
                <p class="text-xs font-bold uppercase text-sky-600">Website</p>
                <h3 class="mt-2 text-2xl font-extrabold">Website Development</h3>
                <div class="mt-5">
                    <span class="text-2xl font-extrabold text-slate-900">Custom Quote</span>
                </div>
                <ul class="mt-6 space-y-2.5 text-sm text-slate-600">
                    <li>✓ Business websites</li>
                    <li>✓ Landing pages</li>
                    <li>✓ React.js / PHP MVC</li>
                    <li>✓ Responsive design</li>
                    <li>✓ SEO-ready</li>
                    <li>✓ 1 month support</li>
                </ul>
                <button onclick="openLeadForm('website')"
                    class="btn-primary mt-7 w-full rounded-xl border border-primary bg-white py-3 text-sm font-bold text-primary">
                    Get a Quote
                </button>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-8">
                <p class="text-xs font-bold uppercase text-green-600">Mobile</p>
                <h3 class="mt-2 text-2xl font-extrabold">Android App Development</h3>
                <div class="mt-5">
                    <span class="text-2xl font-extrabold text-slate-900">Custom Quote</span>
                </div>
                <ul class="mt-6 space-y-2.5 text-sm text-slate-600">
                    <li>✓ React Native + Expo</li>
                    <li>✓ Business apps</li>
                    <li>✓ REST API integration</li>
                    <li>✓ Play Store deploy</li>
                    <li>✓ Push notifications</li>
                    <li>✓ 1 month support</li>
                </ul>
                <button onclick="openLeadForm('android')"
                    class="btn-primary mt-7 w-full rounded-xl border border-green-600 bg-white py-3 text-sm font-bold text-green-600">
                    Get a Quote
                </button>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════ PRODUCT SHOWCASE ═══════════════════ -->
<section id="product" class="product-section overflow-hidden py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="reveal text-center">
            <span class="rounded-full bg-primary px-4 py-2 text-xs font-bold text-white">MY OWN PRODUCT</span>
            <h2 class="mt-6 text-4xl font-extrabold sm:text-6xl">
                Work Smart <span class="gradient-text">CRM</span>
            </h2>
            <p class="mx-auto mt-5 max-w-2xl text-sm leading-7 text-slate-600">
                A simple CRM platform designed for small and growing businesses to manage customers,
                leads, quotations, tasks, tickets and daily activities from one place.
            </p>
        </div>

        <div class="mt-16 grid items-center gap-14 lg:grid-cols-2">
            <div class="reveal">
                <div class="rounded-[2rem] border border-sky-100 bg-white p-5 shadow-blue">
                    <div class="rounded-2xl bg-slate-950 p-5">
                        <div class="flex items-center justify-between">
                            <strong class="text-white">Work Smart CRM</strong>
                            <span
                                class="rounded-full bg-sky-400 px-3 py-1 text-[9px] font-bold text-slate-900">DASHBOARD</span>
                        </div>
                        <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-4">
                            <?php foreach ([['Leads', '128'], ['Customers', '86'], ['Tasks', '42'], ['Tickets', '18']] as $k): ?>
                                <div class="rounded-xl bg-white/10 p-4">
                                    <p class="text-[10px] text-slate-400"><?= $k[0] ?></p>
                                    <p class="mt-2 text-xl font-bold text-white"><?= $k[1] ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-4 h-32 rounded-xl bg-gradient-to-r from-blue-500/20 to-sky-400/20"></div>
                    </div>
                </div>
            </div>

            <div class="reveal">
                <p class="text-xs font-bold uppercase tracking-[.25em] text-primary">Built for businesses</p>
                <h3 class="mt-4 text-3xl font-extrabold sm:text-4xl">
                    Manage your business <span class="gradient-text">smarter.</span>
                </h3>
                <p class="mt-5 text-sm leading-7 text-slate-600">
                    Work Smart CRM brings important business activities together in one simple platform.
                </p>
                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <?php foreach ([
                        ['Lead Management', 'Track and manage business leads.'],
                        ['Customers', 'Keep customer information organized.'],
                        ['Quotations', 'Create and manage quotations.'],
                        ['Tasks & Tickets', 'Organize work and customer support.'],
                    ] as $f): ?>
                        <div class="rounded-2xl bg-white p-5 shadow-sm">
                            <p class="font-bold"><?= $f[0] ?></p>
                            <p class="mt-2 text-xs leading-5 text-slate-500"><?= $f[1] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?= CRM_URL ?>" target="_blank" rel="noopener"
                    class="btn-primary mt-8 inline-flex rounded-full bg-primary px-7 py-3.5 text-sm font-bold text-white">
                    Explore Work Smart CRM ↗
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════ CLIENT REVIEWS (5★) ═══════════════════ -->
<section id="reviews" class="bg-slate-50 py-24 lg:py-32 overflow-hidden">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="reveal text-center">
            <p class="text-xs font-bold uppercase tracking-[.25em] text-primary">Client Reviews</p>
            <h2 class="mt-3 text-4xl font-extrabold sm:text-5xl">
                What clients say <span class="gradient-text">about us</span>
            </h2>
            <div class="mt-5 inline-flex items-center gap-3 rounded-full bg-white px-5 py-2 shadow-sm">
                <div class="flex text-yellow-400 text-lg">
                    ★★★★★
                </div>
                <span class="text-sm font-bold text-slate-800">5.0</span>
                <span class="text-xs text-slate-500">· Based on 47 reviews</span>
            </div>
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-500">
                Real feedback from clients we've worked with on web, mobile and CRM projects.
            </p>
        </div>
    </div>

    <!-- Moving reviews slider -->
    <div class="review-slider mt-14">
        <div class="review-track">
            <?php
            $reviews = [
                [
                    'name' => 'AnandhaKrishnan',
                    'role' => 'Director, RightHMS',
                    'url' => 'https://righthms.com',
                    'text' => 'Bala delivered a clean, professional hospital management website that perfectly matches our brand. Communication was excellent throughout.',
                    'stars' => 5,
                ],
                [
                    'name' => 'AnandhaKrishnan',
                    'role' => 'Owner, Meddoz Pharmacy',
                    'url' => 'https://meddoz.com',
                    'text' => 'The pharmacy billing website Bala built has completely simplified our operations. Fast, responsive and exactly what we needed.',
                    'stars' => 5,
                ],
                [
                    'name' => 'Thanigai Arasu',
                    'role' => 'Founder, Sri Ganesh Foods',
                    'url' => 'https://sriganeshfoods.in',
                    'text' => 'Our catering business website is beautiful and easy to navigate. Bala understood our requirements from day one.',
                    'stars' => 5,
                ],
                [
                    'name' => 'AnandhaKrishnan',
                    'role' => 'CTO, ASkeyCRM',
                    'url' => 'https://crm.askeytech.com',
                    'text' => 'Worked with Bala on our CRM platform. He wrote maintainable code and handled every requirement professionally.',
                    'stars' => 5,
                ],
                [
                    'name' => 'AnandhaKrishnan',
                    'role' => 'Product Lead, ASkeyRetail',
                    'url' => 'https://crm.askeytech.com',
                    'text' => 'Bala built our React Native retail app on time and on budget. Users love how smooth and fast the app is.',
                    'stars' => 5,
                ],
                [
                    'name' => 'AnandhaKrishnan',
                    'role' => 'Manager, RightKOT',
                    'url' => 'https://righthms.com',
                    'text' => 'Our kitchen order management app works flawlessly. Bala handled all API integrations smoothly. Highly recommended.',
                    'stars' => 5,
                ],
                [
                    'name' => 'Praburaj Pandian',
                    'role' => 'Founder, SmartSteno',
                    'url' => 'https://smartsteno.azurewebsites.net',
                    'text' => 'The shorthand learning platform Bala built is used by students across India. Great UI and solid backend.',
                    'stars' => 5,
                ],
                [
                    'name' => 'Tritrix technologies, Fayaz',
                    'role' => 'CEO, Infuex',
                    'url' => 'https://balamurugandev.vercel.app',
                    'text' => 'Wallet, chat and onboarding features built flawlessly in React Native. Bala is a reliable developer.',
                    'stars' => 5,
                ],
            ];

            // Duplicate for seamless infinite marquee
            $reviewsLoop = array_merge($reviews, $reviews);

            foreach ($reviewsLoop as $r):
                ?>
                <article class="review-card rounded-3xl border border-slate-200 bg-white p-7 shadow-soft">
                    <!-- Header: avatar + name + stars -->
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-full bg-primary text-white font-bold text-lg">
                                <?= strtoupper(substr($r['name'], 0, 1)) ?>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800"><?= htmlspecialchars($r['name']) ?></h4>
                                <p class="text-xs text-slate-500"><?= htmlspecialchars($r['role']) ?></p>
                            </div>
                        </div>
                        <div class="text-yellow-400 text-sm">
                            <?= str_repeat('★', (int) $r['stars']) ?>
                        </div>
                    </div>

                    <!-- Review text -->
                    <p class="mt-5 text-sm leading-7 text-slate-600">
                        "<?= htmlspecialchars($r['text']) ?>"
                    </p>

                    <!-- Screenshot thumbnail from cache -->
                    <a href="<?= htmlspecialchars($r['url']) ?>" target="_blank" rel="noopener"
                        class="mt-5 block overflow-hidden rounded-xl border border-slate-100">
                        <img src="<?= screenshot_url($r['url']) ?>" alt="<?= htmlspecialchars($r['name']) ?> project"
                            loading="lazy"
                            class="aspect-[16/9] w-full object-cover object-top transition duration-300 hover:scale-105">
                    </a>

                    <!-- Verified badge -->
                    <div class="mt-4 flex items-center gap-1.5 text-xs text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                            <path fill-rule="evenodd"
                                d="M16.403 12.652a3 3 0 0 0 0-5.304 3 3 0 0 0-3.75-3.751 3 3 0 0 0-5.305 0 3 3 0 0 0-3.751 3.75 3 3 0 0 0 0 5.305 3 3 0 0 0 3.75 3.751 3 3 0 0 0 5.305 0 3 3 0 0 0 3.751-3.75Zm-2.546-4.46a.75.75 0 0 0-1.214-.883l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                clip-rule="evenodd" />
                        </svg>
                        Verified Client
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════ EDUCATION / EXPERIENCE ═══════════════════ -->
<section class="bg-white py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="reveal mb-12">
            <p class="text-xs font-bold uppercase tracking-[.25em] text-primary">Background</p>
            <h2 class="mt-3 text-4xl font-extrabold sm:text-5xl">Education & Experience</h2>
        </div>
        <div class="grid gap-5 md:grid-cols-2">
            <div class="reveal rounded-3xl border border-slate-200 bg-white p-7">
                <span class="text-xs font-bold text-primary">EDUCATION</span>
                <h3 class="mt-4 text-xl font-bold">B.E. Computer Science & Engineering</h3>
                <p class="mt-2 text-sm text-slate-500">Annamalai University</p>
                <p class="mt-4 text-sm text-slate-500">2019 – 2023</p>
                <div class="mt-5 inline-block rounded-full bg-sky-50 px-4 py-2 text-xs font-bold text-primary">
                    OGPA 8.66
                </div>
            </div>

            <div class="reveal rounded-3xl border border-slate-200 bg-white p-7">
                <span class="text-xs font-bold text-primary">PROFESSIONAL</span>
                <h3 class="mt-4 text-xl font-bold">Full Stack & Mobile Development</h3>
                <p class="mt-2 text-sm leading-7 text-slate-500">
                    Experience working on web and mobile applications using React Native,
                    React.js, PHP MVC and MySQL.
                </p>
                <div class="mt-5 inline-block rounded-full bg-sky-50 px-4 py-2 text-xs font-bold text-primary">
                    2+ Years Experience
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════ CONTACT ═══════════════════ -->
<section id="contact" class="bg-white py-24 lg:py-32">
    <div class="mx-auto max-w-5xl px-5 lg:px-8">
        <div class="reveal rounded-[2rem] bg-slate-950 p-8 text-center text-white shadow-blue sm:p-14">
            <p class="text-xs font-bold uppercase tracking-[.25em] text-sky-400">Let's Work Together</p>

            <h2 class="mt-4 text-4xl font-extrabold sm:text-5xl">
                Have a project <span class="text-sky-400">in mind?</span>
            </h2>

            <p class="mx-auto mt-5 max-w-xl text-sm leading-7 text-slate-400">
                I'm open to development opportunities, freelance projects and business applications.
            </p>

            <div class="mt-9 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <button onclick="openLeadForm('crm')"
                    class="btn-primary rounded-full bg-sky-400 px-7 py-3.5 text-sm font-bold text-slate-950">
                    Start an Enquiry
                </button>
                <a href="tel:+919384902854"
                    class="rounded-full border border-white/20 px-7 py-3.5 text-sm font-bold text-white transition hover:border-sky-400 hover:text-sky-400">
                    Call Me
                </a>
            </div>

            <div class="mt-10 grid gap-3 text-sm text-slate-400 sm:grid-cols-2">
                <a href="mailto:snbalamurugan20@gmail.com" class="transition hover:text-sky-400">
                    snbalamurugan20@gmail.com
                </a>
                <a href="tel:+919384902854" class="transition hover:text-sky-400">
                    +91 93849 02854
                </a>
            </div>

            <div class="mt-8 flex justify-center gap-5">
                <a href="https://github.com/15balamurugan" target="_blank" rel="noopener"
                    class="text-sm font-semibold text-slate-400 transition hover:text-white">GitHub</a>
                <a href="https://www.linkedin.com/in/bala-murugan-34a7bb244" target="_blank" rel="noopener"
                    class="text-sm font-semibold text-slate-400 transition hover:text-white">LinkedIn</a>
                <a href="<?= PORTFOLIO_URL ?>" target="_blank" rel="noopener"
                    class="text-sm font-semibold text-slate-400 transition hover:text-white">Portfolio</a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════ FOOTER ═══════════════════ -->
<footer class="border-t border-slate-100 bg-white py-8">
    <div
        class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-5 text-center sm:flex-row lg:px-8">
        <p class="text-xs text-slate-400">© <?= date('Y') ?> Bala Murugan. All rights reserved.</p>
        <p class="text-xs text-slate-400">Full Stack Engineer · React Native · React.js</p>
    </div>
</footer>

<!-- ═══════════════════ LEAD MODAL ═══════════════════ -->
<div id="leadModal"
    class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm">
    <div class="w-full max-w-lg rounded-3xl bg-white p-7 shadow-2xl">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-primary">Enquire Now</p>
                <h3 id="modalTitle" class="mt-1 text-2xl font-extrabold">Let's Talk</h3>
            </div>
            <button onclick="closeLeadForm()"
                class="text-2xl leading-none text-slate-400 hover:text-slate-800">&times;</button>
        </div>

        <form id="leadForm" class="mt-5 space-y-3" onsubmit="submitLead(event)">
            <input type="hidden" name="package" id="leadPackage" />

            <input name="name" required placeholder="Your name"
                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-primary focus:outline-none" />

            <input name="email" type="email" required placeholder="Email address"
                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-primary focus:outline-none" />

            <input name="phone" required placeholder="WhatsApp number (e.g. 919384902854)"
                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-primary focus:outline-none" />

            <textarea name="message" rows="3" placeholder="Your message (optional)"
                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-primary focus:outline-none"></textarea>

            <div id="leadPrice" class="text-xs text-slate-500"></div>

            <button type="submit" id="leadSubmit"
                class="btn-primary w-full rounded-xl bg-primary py-3 text-sm font-bold text-white">
                Send Enquiry & Open WhatsApp
            </button>
            <p id="leadResult" class="text-xs"></p>
        </form>
    </div>
</div>

<!-- ═══════════════════ FLOATING WHATSAPP BUTTON ═══════════════════ -->
<a href="<?= wa_link('Hi Bala, I am interested in your services') ?>" target="_blank" rel="noopener"
    class="fixed bottom-6 right-6 z-40 flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-white shadow-xl transition hover:scale-110"
    aria-label="Chat on WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-7 w-7">
        <path
            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
        <path
            d="M20.52 3.449C18.24 1.245 15.24 0 12.045 0 5.463 0 .104 5.334.101 11.892c0 2.096.549 4.142 1.595 5.945L0 24l6.335-1.652a12.02 12.02 0 0 0 5.71 1.447h.006c6.585 0 11.946-5.336 11.949-11.896 0-3.176-1.24-6.165-3.495-8.411z" />
    </svg>
</a>

<!-- ═══════════════════ JAVASCRIPT ═══════════════════ -->
<script src="/assets/js/main.js"></script>

</body>

</html>