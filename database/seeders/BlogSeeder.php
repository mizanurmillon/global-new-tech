<?php
namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        Blog::insert([
            [
                'title'             => 'DevSecOps Best Practices for 2026',
                'image'             => '/uploads/blogs/blog1.png',
                'short_description' => "In today's fast-paced digital environment, security can no longer be treated as an afterthought. DevSecOps integrates security",
                'long_description'  => "In today's fast-paced digital environment, security can no longer be treated as an afterthought. DevSecOps integrates security practices directly into the DevOps pipeline, ensuring that applications are built, tested, and deployed with security at every stage of the development lifecycle.

This guide explores the essential DevSecOps practices that help teams identify vulnerabilities early, automate security testing, and maintain continuous monitoring throughout the deployment process. By embedding security into development workflows, organizations can reduce risks, improve compliance, and deliver reliable software faster.

You’ll learn how modern development teams implement secure coding standards, use automated security tools, manage secrets safely, and integrate vulnerability scanning into CI/CD pipelines. Whether you're a developer, security professional, or product manager, adopting DevSecOps practices will help you create resilient and trustworthy applications from the ground up.",
                'is_active'         => true,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],

            [
                'title'             => 'Top 10 Cybersecurity Threats in 2026',
                'image'             => '/uploads/blogs/blog2.png',
                'short_description' => "Cybersecurity threats are evolving rapidly as technology continues to advance. In 2026,  businesses face increasingly sophisticated a",
                'long_description'  => "Artificial Intelligence is rapidly changing the landscape of web development. From automated code generation to intelligent testing, AI tools are helping developers build faster and smarter applications.

Modern frameworks are now integrating AI-powered features such as code suggestions, bug detection, and performance optimization. This reduces manual effort and increases productivity across development teams.

By leveraging AI, developers can focus more on creativity and problem-solving while automating repetitive tasks. The future of web development is undoubtedly AI-driven.",
                'is_active'         => true,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],

            [
                'title'             => 'Wireless Technology Is Change',
                'image'             => '/uploads/blogs/blog3.png',
                'short_description' => "State machines are a powerful tool in the software developer's toolkit, offering a structured and manageable approach to handling system",
                'long_description'  => "Cloud computing continues to evolve, offering more scalable, secure, and cost-effective solutions for businesses worldwide. In 2026, trends like serverless architecture, multi-cloud strategies, and edge computing are dominating the industry.

Organizations are increasingly adopting hybrid cloud environments to balance performance and flexibility. Meanwhile, advancements in cloud security and automation are making deployments more reliable than ever.

Staying updated with cloud trends is essential for developers and businesses aiming to build future-ready applications.",
                'is_active'         => true,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
