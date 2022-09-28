<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\User;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ok('Users', Employee::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();
        $createdUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'last_name' => $data['last_name'],
            'password' => bcrypt($data['password']),
        ]);
        if(empty($createdUser)){
            throw new \Exception('Cannot update user');
        }
        $createdUser->assignRole('employee');
        $employeeCreated = Employee::create([
            'user_id' => $createdUser->id,
            'company_id' => $data['company_id'],
            'phone' => $data['phone'],
        ]);
        if(empty($employeeCreated)){
            throw new \Exception('Cannot update employee');
        }
        return ok('Created an employee', $employeeCreated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return ok('Employee', $employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();
        $user = User::find($employee->user_id);

        isset($data['name']) ? $user->name = $data['name'] : null;
        isset($data['email']) ? $user->email = $data['email'] : null;
        isset($data['last_name']) ? $user->last_name = $data['last_name'] : null;
        isset($data['password']) ? $user->password = bcrypt($data['password']) : null;
        $updatedUser = $user->save();
        if(empty($updatedUser)){
            throw new \Exception('Cannot update user');
        }
        isset($data['company_id']) ? $employee->company_id = $data['company_id'] : null;
        isset($data['phone']) ? $employee->phone = $data['phone'] : null;
        $updatedEmployee = $employee->save();
        if(empty($updatedEmployee)){
            throw new \Exception('Cannot update emmployee');
        }
        return ok('Employee has been updated', $employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        User::find($employee->user_id)->delete();

        return ok('Employee has been deleted', $employee);
    }
}
