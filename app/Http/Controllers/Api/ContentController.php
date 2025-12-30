<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Get paginated content list
     */
    public function index(Request $request)
    {
        $query = Content::with('category');

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by type (through category relationship)
        if ($request->has('type')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        // Search by title or body
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $contents = $query->latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $contents,
        ]);
    }

    /**
     * Get single content details
     */
    public function show($id)
    {
        $content = Content::with('category')->find($id);

        if (!$content) {
            return response()->json([
                'success' => false,
                'message' => 'Content not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $content,
        ]);
    }
}
