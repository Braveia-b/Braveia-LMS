<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('landing.index', [
            'meta' => [
                'title' => 'NexLearn — AI-Powered Learning Management System',
                'description' => 'Transform learning into interactive digital experiences with NexLearn. Premium LMS platform with AI assistant, live classes, analytics, and more.',
                'keywords' => 'LMS, learning management system, online courses, AI education, e-learning platform',
            ],
            'stats' => [
                ['value' => '50K+', 'label' => 'Active Students'],
                ['value' => '2.4K+', 'label' => 'Expert Courses'],
                ['value' => '98%', 'label' => 'Satisfaction Rate'],
                ['value' => '120+', 'label' => 'Countries'],
            ],
            'partners' => ['Google', 'Microsoft', 'Adobe', 'Meta', 'OpenAI'],
            'features' => [
                [
                    'icon' => 'brain',
                    'title' => 'AI Learning Assistant',
                    'description' => 'Personalized AI tutor that adapts to each student\'s pace and learning style in real-time.',
                    'size' => 'large',
                ],
                [
                    'icon' => 'video',
                    'title' => 'Video Course',
                    'description' => 'HD streaming with chapters, notes, and interactive timestamps.',
                    'size' => 'small',
                ],
                [
                    'icon' => 'quiz',
                    'title' => 'Quiz Interactive',
                    'description' => 'Gamified assessments with instant feedback and analytics.',
                    'size' => 'small',
                ],
                [
                    'icon' => 'dashboard',
                    'title' => 'Student Dashboard',
                    'description' => 'Unified hub for progress, assignments, and achievements.',
                    'size' => 'medium',
                ],
                [
                    'icon' => 'certificate',
                    'title' => 'Certificate Generator',
                    'description' => 'Auto-generate verified certificates upon course completion.',
                    'size' => 'small',
                ],
                [
                    'icon' => 'live',
                    'title' => 'Live Class',
                    'description' => 'Real-time virtual classrooms with breakout rooms and whiteboard.',
                    'size' => 'medium',
                ],
                [
                    'icon' => 'progress',
                    'title' => 'Progress Tracking',
                    'description' => 'Visual analytics and milestone tracking for learners and admins.',
                    'size' => 'small',
                ],
                [
                    'icon' => 'forum',
                    'title' => 'Discussion Forum',
                    'description' => 'Community-driven Q&A with moderation and peer learning.',
                    'size' => 'small',
                ],
            ],
            'courses' => [
                [
                    'title' => 'Machine Learning Fundamentals',
                    'instructor' => 'Dr. Sarah Chen',
                    'rating' => 4.9,
                    'students' => '12.4K',
                    'progress' => 68,
                    'category' => 'AI & Data',
                    'color' => 'from-violet-600 to-indigo-600',
                ],
                [
                    'title' => 'Full-Stack Web Development',
                    'instructor' => 'Alex Rivera',
                    'rating' => 4.8,
                    'students' => '18.2K',
                    'progress' => 45,
                    'category' => 'Development',
                    'color' => 'from-cyan-500 to-blue-600',
                ],
                [
                    'title' => 'UI/UX Design Masterclass',
                    'instructor' => 'Maya Patel',
                    'rating' => 4.9,
                    'students' => '9.8K',
                    'progress' => 82,
                    'category' => 'Design',
                    'color' => 'from-fuchsia-500 to-purple-600',
                ],
                [
                    'title' => 'Digital Marketing Strategy',
                    'instructor' => 'James Wilson',
                    'rating' => 4.7,
                    'students' => '7.1K',
                    'progress' => 33,
                    'category' => 'Business',
                    'color' => 'from-amber-500 to-orange-600',
                ],
            ],
            'testimonials' => [
                [
                    'name' => 'Elena Rodriguez',
                    'role' => 'CEO, EduTech Global',
                    'avatar' => 'ER',
                    'content' => 'NexLearn transformed how we deliver corporate training. The AI assistant alone saved our team 40 hours per week.',
                    'rating' => 5,
                ],
                [
                    'name' => 'David Kim',
                    'role' => 'Head of Learning, InnovateCo',
                    'avatar' => 'DK',
                    'content' => 'The most intuitive LMS we\'ve ever used. Our course completion rates jumped from 62% to 94% in three months.',
                    'rating' => 5,
                ],
                [
                    'name' => 'Priya Sharma',
                    'role' => 'Founder, CodeAcademy Pro',
                    'avatar' => 'PS',
                    'content' => 'Premium design meets powerful features. Our students love the dashboard and live class experience.',
                    'rating' => 5,
                ],
                [
                    'name' => 'Michael Torres',
                    'role' => 'Director, LearnForward',
                    'avatar' => 'MT',
                    'content' => 'From onboarding to analytics, everything feels polished. It\'s like Linear met education — in the best way.',
                    'rating' => 5,
                ],
            ],
            'pricing' => [
                [
                    'name' => 'Starter',
                    'monthly' => 29,
                    'yearly' => 24,
                    'description' => 'Perfect for individual educators',
                    'features' => ['Up to 100 students', '5 courses', 'Basic analytics', 'Email support', 'Certificate generator'],
                    'popular' => false,
                ],
                [
                    'name' => 'Professional',
                    'monthly' => 79,
                    'yearly' => 65,
                    'description' => 'For growing institutions',
                    'features' => ['Up to 1,000 students', 'Unlimited courses', 'AI Learning Assistant', 'Live classes', 'Advanced analytics', 'Priority support'],
                    'popular' => true,
                ],
                [
                    'name' => 'Enterprise',
                    'monthly' => 199,
                    'yearly' => 165,
                    'description' => 'For large organizations',
                    'features' => ['Unlimited students', 'Custom branding', 'SSO & API access', 'Dedicated manager', 'SLA guarantee', 'White-label option'],
                    'popular' => false,
                ],
            ],
            'faqs' => [
                [
                    'question' => 'What makes NexLearn different from other LMS platforms?',
                    'answer' => 'NexLearn combines cutting-edge AI personalization with a premium, intuitive interface. Our platform adapts to each learner while giving instructors powerful analytics and automation tools.',
                ],
                [
                    'question' => 'Can I migrate from my existing LMS?',
                    'answer' => 'Yes. We offer free migration assistance for Professional and Enterprise plans, including course content, student data, and certificates.',
                ],
                [
                    'question' => 'Is there a free trial available?',
                    'answer' => 'Absolutely. Start with a 14-day free trial on any plan — no credit card required. Experience the full platform before committing.',
                ],
                [
                    'question' => 'Does NexLearn support live virtual classrooms?',
                    'answer' => 'Yes. Built-in live classes include video, screen sharing, breakout rooms, interactive whiteboard, and automatic attendance tracking.',
                ],
                [
                    'question' => 'How does the AI Learning Assistant work?',
                    'answer' => 'Our AI analyzes learning patterns, identifies knowledge gaps, and provides personalized recommendations, quizzes, and study plans for each student.',
                ],
                [
                    'question' => 'What kind of support do you offer?',
                    'answer' => 'Starter includes email support. Professional gets priority 24/7 chat. Enterprise includes a dedicated success manager and custom SLA.',
                ],
            ],
        ]);
    }
}
