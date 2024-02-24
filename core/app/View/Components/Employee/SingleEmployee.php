<?php

namespace App\View\Components\Employee;

use Illuminate\View\Component;

class SingleEmployee extends Component
{
    private $employee;
    /**
     * @var null
     */
    private $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($employee, $id = null)
    {
        $this->employee = $employee;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.employee.single-employee', [
            'employee' => $this->employee
        ]);
    }
}
