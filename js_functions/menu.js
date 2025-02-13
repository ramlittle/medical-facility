function confirmLogout(){
    const confirmedLogout=window.confirm("You are about to be logged out");
        if(confirmedLogout){
            return true;
        }
        return false;
}
