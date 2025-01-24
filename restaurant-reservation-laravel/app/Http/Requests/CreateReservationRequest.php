<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    public function authorize()
    {
        // Allow only authorized users (e.g., logged-in users)
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:restaurant_reservation_users,id',
            'table_number' => 'required|exists:restaurant_reservation_tables,table_number',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_guests' => 'required|integer|min:1|max:10',
            'special_request' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'მომხმარებლის ID აუცილებელია.',
            'user_id.exists' => 'მოცემული მომხმარებელი არ არსებობს.',
            'table_number.required' => 'მაგიდის ნომერი აუცილებელია.',
            'table_number.exists' => 'მოცემული მაგიდა არ არსებობს.',
            'reservation_date.required' => 'ჯავშნის თარიღი აუცილებელია.',
            'reservation_date.date' => 'ჯავშნის თარიღი უნდა იყოს სწორი ფორმატით.',
            'reservation_date.after_or_equal' => 'ჯავშნის თარიღი უნდა იყოს დღევანდელი ან მომავალი.',
            'reservation_time.required' => 'ჯავშნის დრო აუცილებელია.',
            'reservation_time.date_format' => 'დრო უნდა იყოს ფორმატით HH:MM.',
            'number_of_guests.required' => 'სტუმრების რაოდენობა აუცილებელია.',
            'number_of_guests.min' => 'სტუმრების რაოდენობა მინიმუმ 1 უნდა იყოს.',
            'number_of_guests.max' => 'სტუმრების რაოდენობა მაქსიმუმ 10 უნდა იყოს.',
            'special_request.max' => 'სპეციალური მოთხოვნა 255 სიმბოლოზე ნაკლები უნდა იყოს.',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id ?? null,
        ]);
    }
}
