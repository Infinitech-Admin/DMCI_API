<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionsSeeder extends Seeder
{
    public function run(): void
    {
        $records = [
            [
                'question' => 'What is the process of buying a home?',
                'answer' => 'The process involves several steps, including finding a property, securing financing, making an offer, and closing the deal.',
                'status' => 'active',
            ],
            [
                'question' => 'How do I know if a property is a good investment?',
                'answer' => 'Research market trends, check the neighborhood’s potential, and consult with a real estate agent or financial advisor to assess the investment.',
                'status' => 'active',
            ],
            [
                'question' => 'What is the difference between renting and buying a property?',
                'answer' => 'Buying a property involves ownership and equity building, while renting is a temporary arrangement without ownership.',
                'status' => 'active',
            ],
            [
                'question' => 'What factors affect property prices?',
                'answer' => 'Location, market demand, property condition, and economic factors like interest rates all affect property prices.',
                'status' => 'active',
            ],
            [
                'question' => 'How much down payment is needed to buy a home?',
                'answer' => 'Typically, a 20% down payment is recommended, but it can vary depending on the lender and loan type.',
                'status' => 'active',
            ],
            [
                'question' => 'What should I look for in a property inspection?',
                'answer' => 'Check for structural issues, plumbing, electrical systems, roofing condition, and signs of pest infestation.',
                'status' => 'active',
            ],
            [
                'question' => 'How do I calculate the value of a property?',
                'answer' => 'Factors like location, size, age, condition, and recent sales in the area help determine the value of a property.',
                'status' => 'active',
            ],
            [
                'question' => 'What is escrow in a real estate transaction?',
                'answer' => 'Escrow is a neutral third party that holds funds during the transaction until all conditions of the deal are met.',
                'status' => 'active',
            ],
            [
                'question' => 'How long does it take to close a property deal?',
                'answer' => 'Typically, closing can take anywhere from 30 to 60 days, depending on the complexity of the transaction.',
                'status' => 'active',
            ],
            [
                'question' => 'What is the difference between a buyer\'s agent and a seller\'s agent?',
                'answer' => 'A buyer\'s agent represents the interests of the buyer, while a seller\'s agent works for the seller to market and sell the property.',
                'status' => 'active',
            ],
        ];

        foreach($records as $record){
            Question::create($record);
        }
    }
}
