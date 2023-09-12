<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use Exception;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PersonResource::collection(Person::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonRequest $request)
    {
        $validated = $request->validated();
        return new PersonResource(Person::create($validated));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $user_id)
    {
        try {
            return new PersonResource(Person::findOrFail($user_id));
        } catch (Exception $e) {
            return response(["message" => "User($user_id) not found."], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonRequest $request, string $user_id)
    {
        try {

            $validated = $request->validated();
            $person = Person::findOrFail($user_id);
            $person->name = $validated['name'];
            $person->save();
            return new PersonResource($person);
        } catch (Exception $e) {
            return response(["message" => "User($user_id) not found."], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user_id)
    {
        Person::destroy($user_id);
        return response(status: 204);
    }
}
