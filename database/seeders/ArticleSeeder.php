<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $records = [
            [
                'headline' => 'Real Estate Market Trends in 2025',
                'content' => 'The real estate market is showing promising signs of growth in 2025, with increased demand for suburban properties and a surge in luxury home sales.',
                'date' => '2025-01-06',
                'image' => 'uploads/articles/market-trends.jpg',
            ],
            [
                'headline' => 'Top 5 Cities for Real Estate Investment in 2025',
                'content' => 'These five cities are expected to be the hottest spots for real estate investment in 2025, offering lucrative opportunities for investors looking for high returns.',
                'date' => '2025-01-05',
                'image' => 'uploads/articles/investment-cities.jpg',
            ],
            [
                'headline' => 'How to Secure a Mortgage for Your Dream Home',
                'content' => 'Securing a mortgage can be tricky, but with the right knowledge, you can navigate the process easily. Here are tips to get the best mortgage rates for your new home.',
                'date' => '2025-01-04',
                'image' => 'uploads/articles/mortgage-guide.jpg',
            ],
            [
                'headline' => 'The Future of Smart Homes in Real Estate',
                'content' => 'Smart homes are revolutionizing the real estate market, with advanced technology providing convenience, security, and energy efficiency for homeowners.',
                'date' => '2025-01-03',
                'image' => 'uploads/articles/smart-homes.jpg',
            ],
            [
                'headline' => 'Tips for First-Time Home Buyers in 2025',
                'content' => 'If you are a first-time homebuyer, these tips will help guide you through the process, from choosing the right property to securing financing.',
                'date' => '2025-01-02',
                'image' => 'uploads/articles/first-time-buyers.jpg',
            ],
            [
                'headline' => 'Real Estate Trends You Need to Know in 2025',
                'content' => 'Discover the top real estate trends for 2025, including the shift to remote work driving demand for larger homes and properties in quieter areas.',
                'date' => '2025-01-01',
                'image' => 'uploads/articles/real-estate-trends.jpg',
            ],
            [
                'headline' => 'Why 2025 is the Year to Invest in Real Estate',
                'content' => 'With interest rates remaining low and demand for properties rising, 2025 is shaping up to be an excellent year to make a real estate investment.',
                'date' => '2024-12-31',
                'image' => 'uploads/articles/invest-in-real-estate.jpg',
            ],
            [
                'headline' => 'The Impact of Sustainable Design on Real Estate Prices',
                'content' => 'Sustainable and eco-friendly designs are becoming increasingly popular among homebuyers, leading to higher property values in environmentally conscious areas.',
                'date' => '2024-12-30',
                'image' => 'uploads/articles/sustainable-design.jpg',
            ],
            [
                'headline' => 'Navigating the Real Estate Market Post-Pandemic',
                'content' => 'As the world recovers from the pandemic, the real estate market is shifting in new directions. Learn how to adjust your investment strategies in this new environment.',
                'date' => '2024-12-29',
                'image' => 'uploads/articles/post-pandemic-market.jpg',
            ],
            [
                'headline' => 'How Virtual Tours are Changing Real Estate Sales',
                'content' => 'Virtual tours have become a game-changer in real estate sales, allowing potential buyers to explore properties from the comfort of their homes and make informed decisions.',
                'date' => '2024-12-28',
                'image' => 'uploads/articles/virtual-tours.jpg',
            ],
        ];

        foreach($records as $record){
            Article::create($record);
        }
    }
}
