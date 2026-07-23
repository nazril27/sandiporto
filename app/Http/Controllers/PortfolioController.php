<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile = [
            'name' => 'Sandi',
            'japanese_name' => 'サンディ',
            'title' => 'Full-Stack Developer & Minimalist UI Designer',
            'tagline' => 'これがいい (Kore ga ii) — This is enough.',
            'bio' => 'Focusing on clean code, thoughtful architecture, and minimalist user experiences. Believing that simplicity is not the absence of clutter, but the presence of purpose.',
            'location' => 'Jakarta, Indonesia',
            'email' => 'sandi@example.com',
            'status' => 'Available for new projects & collaborations',
            'github' => 'https://github.com',
            'linkedin' => 'https://linkedin.com',
            'twitter' => 'https://x.com',
        ];

        $principles = [
            [
                'number' => '01',
                'title_jp' => '素材の厳選',
                'title_en' => 'Selection of Technologies',
                'desc' => 'Choosing lightweight, reliable, and modern frameworks to ensure performance and sustainability without unnecessary complexity.'
            ],
            [
                'number' => '02',
                'title_jp' => '工程の簡略化',
                'title_en' => 'Streamlined Engineering',
                'desc' => 'Eliminating bloated dependencies and repetitive logic. Crafting modular, readable, and maintainable software architecture.'
            ],
            [
                'number' => '03',
                'title_jp' => '機能への専念',
                'title_en' => 'Purposeful Utility',
                'desc' => 'Every visual element and line of code serves a direct purpose. Uncompromising usability over decorative distractions.'
            ],
            [
                'number' => '04',
                'title_jp' => '普遍的な価値',
                'title_en' => 'Timeless Quality',
                'desc' => 'Designing digital interfaces and systems that remain functional, readable, and elegant across time and devices.'
            ],
        ];

        $projects = [
            [
                'id' => 1,
                'number' => 'WORK 01',
                'title' => 'Minimalist E-Commerce Suite',
                'title_jp' => '無印風 Eコマースプラットフォーム',
                'category' => 'web',
                'category_label' => 'Web Application',
                'year' => '2025',
                'image' => '/images/project1.jpg',
                'summary' => 'A calm, distraction-free shopping platform built with Laravel & Alpine.js.',
                'description' => 'Designed with a warm neutral color palette and zero visual noise, this platform streamlines checkout into 2 clicks while offering real-time inventory management.',
                'tags' => ['Laravel', 'Blade', 'TailwindCSS', 'Alpine.js', 'PostgreSQL'],
                'link' => '#',
                'featured' => true
            ],
            [
                'id' => 2,
                'number' => 'WORK 02',
                'title' => 'Seiri — Task & Workspace App',
                'title_jp' => '整理 (Seiri) タスク管理',
                'category' => 'design',
                'category_label' => 'UI/UX & Mobile App',
                'year' => '2025',
                'image' => '/images/project2.jpg',
                'summary' => 'Zen-inspired task tracker prioritizing focus, quiet aesthetics, and keyboard shortcuts.',
                'description' => 'A productivity application designed to reduce digital anxiety. Features markdown support, offline sync, and calm soundscapes.',
                'tags' => ['Vue.js', 'Laravel API', 'PWA', 'TailwindCSS'],
                'link' => '#',
                'featured' => true
            ],
            [
                'id' => 3,
                'number' => 'WORK 03',
                'title' => 'Kura — Asset & Inventory System',
                'title_jp' => '蔵 (Kura) 資産・在庫管理',
                'category' => 'architecture',
                'category_label' => 'System Architecture',
                'year' => '2024',
                'image' => '/images/project3.jpg',
                'summary' => 'High-performance inventory management software for creative studios and stores.',
                'description' => 'A robust backend system with minimal UI overhead, capable of handling barcode scanning, automated reordering, and analytics.',
                'tags' => ['Laravel', 'Redis', 'Docker', 'REST API'],
                'link' => '#',
                'featured' => true
            ]
        ];

        $skills = [
            'Backend & Core' => [
                ['name' => 'PHP / Laravel', 'level' => '95%'],
                ['name' => 'MySQL / PostgreSQL', 'level' => '90%'],
                ['name' => 'RESTful API & GraphQL', 'level' => '88%'],
                ['name' => 'Node.js', 'level' => '82%']
            ],
            'Frontend & Styling' => [
                ['name' => 'JavaScript (ES6+)', 'level' => '92%'],
                ['name' => 'TailwindCSS / CSS3', 'level' => '95%'],
                ['name' => 'Alpine.js / Vue.js', 'level' => '85%'],
                ['name' => 'HTML5 / Accessibility', 'level' => '95%']
            ],
            'Tools & Methodology' => [
                ['name' => 'Git / Version Control', 'level' => '90%'],
                ['name' => 'UI/UX & Grid Systems', 'level' => '88%'],
                ['name' => 'Docker & Deployment', 'level' => '80%'],
                ['name' => 'Performance Optimization', 'level' => '85%']
            ]
        ];

        $experiences = [
            [
                'period' => '2023 — Present',
                'role' => 'Senior Full-Stack Engineer',
                'company' => 'Studio Minimal',
                'desc' => 'Leading development of web applications and design systems with focus on code purity and speed.'
            ],
            [
                'period' => '2021 — 2023',
                'role' => 'Laravel Developer',
                'company' => 'Komorebi Digital',
                'desc' => 'Built scalable enterprise APIs, customized CMS solutions, and integrated payment gateways.'
            ],
            [
                'period' => '2019 — 2021',
                'role' => 'Junior Web Designer & Developer',
                'company' => 'Craft Studio',
                'desc' => 'Created responsive websites and graphic branding assets for local and international clients.'
            ]
        ];

        return view('portfolio.index', compact('profile', 'principles', 'projects', 'skills', 'experiences'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan Anda telah berhasil terkirim. Terima kasih! / Thank you for reaching out.'
        ]);
    }
}
