<div>

@hasrole('system-administrator')
    I AM THE SYSTEM ADMINISTRATOR
@endhasrole

@hasrole('account-manager')
    I AM AN ACCOUNT MANAGER
@endhasrole

@hasrole('membership-manager')
    I AM AN MEMBERSHIP MANAGER
@endhasrole


  @hasrole('system-administrator account-manager')
  <div class="inline-block">
      
      <div class="bg-teal-400 block py-6 px-4">Auth::user()->hasRole('system-administrator') = {{ Auth::user()->hasRole('system-administrator')}}</div>
      <div class="bg-teal-400 block py-6 px-4">Auth::user()->hasRole('account-manager') = {{ Auth::user()->hasRole('account-manager')}}</div>
      <div class="bg-teal-400 block py-6 px-4">Auth::user()->hasRole('membership-manager') = {{ Auth::user()->hasRole('membership-manager')}}</div>
      <div class="bg-teal-400 block py-6 px-4">Auth::user()->name = {{ Auth::user()->name}}</div>
      <div class="bg-teal-400 block py-6 px-4">Auth::user()->id = {{ Auth::user()->id}}</div>
      <div class="bg-teal-400 block py-6 px-4">Auth::user()->guard = {{ Auth::user()->guard}}</div>
  </div>

  @endhasrole

  @hasrole('contact'))
  <div class="inline-block">
      
      <div class="py-4 px-2 bg-blue-100">Auth::guard('contact')->user()->name = {{ Auth::guard('contact')->user()->name}}<br>
          Auth::user()->name = {{ Auth::user()->name}}<br>
      </div>

  </div> 
  @endhasrole   
</div>