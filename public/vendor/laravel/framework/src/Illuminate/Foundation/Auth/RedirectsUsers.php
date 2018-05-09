<?php

namespace Illuminate\Foundation\Auth;
use Auth;

trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (Auth::user()->role == 'Resident') {
              if (method_exists($this, 'redirectToResident')) {
                    return $this->redirectTo();
                }
            return property_exists($this, 'redirectToResident') ? $this->redirectToResident : '/home';
        }elseif(Auth::user()->role == 'Clerk')
        {
            return '/admin/clerk/request';
        }else{
             if (method_exists($this, 'redirectToAdmin')) {
                    return $this->redirectTo();
             }

            return property_exists($this, 'redirectToAdmin') ? $this->redirectToAdmin : '/admin/credentials';
        }
       
    }
}
