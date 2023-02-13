<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function users() {
        // l'utente loggato
        $user = Auth::user();

        $users = User::orderBy("created_at", "DESC")->limit(5)->get();

        $lastProjects = Project::orderBy("created_at", "DESC")->limit(5)->get();

        return view("admin.users", [
            // "users" => isset($users) ? $users : null
            "users" => $users ?? null,
            "lastPosts" => $lastProjects,
        ]);

    }
        public function dashboard() {
            // l'utente loggato
            $user = Auth::user();
    
            // Lista di tutti gli utenti nel db
            if ($user->role === "admin") {
                $users = User::orderBy("created_at", "DESC")->limit(5)->get();
            }
    
            $lastProjects = Project::orderBy("created_at", "DESC")->limit(5)->get();
    
            return view("admin.dashboard", [
                // "users" => isset($users) ? $users : null
                "users" => $users ?? null,
                "lastPosts" => $lastProjects,
            ]);
        }
}