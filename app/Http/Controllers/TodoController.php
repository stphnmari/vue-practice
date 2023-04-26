<?php
  
namespace App\Http\Controllers;
  
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
  
class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $todolist= Todo::latest()->paginate(5);
        
        return view('todolist.index',compact('todolist'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('todolist.create');
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'description' => 'required',
            'date' => 'required',
        ]);
        
        Todo::create($request->all());
         
        return redirect()->route('todolist.index')
                        ->with('success','Task is successfully created');
    }
  
    /**
     * Display the specified resource.
     */
   public function show($id)
{
    $todo = Todo::find($id);
    return view('todolist.show', compact('todo'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $todo = Todo::find($id);
        return view('todolist.edit', compact('todo'));
    }
    
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo): RedirectResponse
    {
        $request->validate([
            'description' => 'required',
            'date' => 'required',
        ]);
        
        $todo->update($request->all());
        
        return redirect()->route('todolist.index')
                        ->with('success','Task is successfully updated ');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $todo = Todo::find($id);
        $todo->delete();
        
        return redirect()->route('todolist.index')
                        ->with('success','A Task is deleted successfully');
        
    }
}