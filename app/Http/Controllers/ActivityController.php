<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ActivityController extends Controller
{
    // afficher la liste des activités sur la page d'accueil home
    public function index()
    {
        $activities = Activity::orderBy('date', 'asc')
                              ->where('date', '>=', now()->format('Y-m-d'))
                              ->paginate(6);

        return Inertia::render('Home', [
            'activities' => $activities
        ]);
    }

    // afficher les détails d'une activité
    public function show(Activity $activity)
    {
        return Inertia::render('Activities/Show', [
            'activity' => $activity
        ]);
    }

    // tableau de bord page admin
    public function dashboard()
    {
        return Inertia::render('Dashboard', [
            'activities' => Auth::user()->activities()
            ->orderBy('date', 'desc')
            ->paginate(perPage: 6)
        ]);
    }

    // Stocke une nouvelle activité dans la bdd
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url|max:255',
            'location' => 'nullable|string|max:255',
            'date' => 'required|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'sport_type' => 'nullable|string|max:255',
            'is_accessible_mobility' => 'boolean',
            'is_accessible_vision' => 'boolean',
            'is_accessible_hearing' => 'boolean',
            'is_accessible_cognitive' => 'boolean',
            'accessibility_details' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        $activity = Auth::user()->activities()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Activité créée avec succès !');
    }

    // Met à jour une activité existante.
    public function update(Request $request, Activity $activity)
    {
        if ($activity->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette activité.');
        }

        $data = $request->all();
        $data['is_accessible_mobility'] = filter_var($data['is_accessible_mobility'], FILTER_VALIDATE_BOOLEAN);
        $data['is_accessible_vision'] = filter_var($data['is_accessible_vision'], FILTER_VALIDATE_BOOLEAN);
        $data['is_accessible_hearing'] = filter_var($data['is_accessible_hearing'], FILTER_VALIDATE_BOOLEAN);
        $data['is_accessible_cognitive'] = filter_var($data['is_accessible_cognitive'], FILTER_VALIDATE_BOOLEAN);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url|max:255',
            'location' => 'nullable|string|max:255',
            'date' => 'required|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'sport_type' => 'nullable|string|max:255',
            'is_accessible_mobility' => 'boolean',
            'is_accessible_vision' => 'boolean',
            'is_accessible_hearing' => 'boolean',
            'is_accessible_cognitive' => 'boolean',
            'accessibility_details' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        $activity->update($validated);

        return redirect()->route('dashboard')->with('success', 'Activité mise à jour avec succès !');
    }

    // Supprime une activité.
    public function destroy(Activity $activity)
    {
        if ($activity->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à supprimer cette activité.');
        }

        $activity->delete();

        return redirect()->route('dashboard')->with('success', 'Activité supprimée avec succès !');
    }
}
