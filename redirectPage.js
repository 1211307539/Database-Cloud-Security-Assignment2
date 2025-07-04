function redirectPage(destination) {
    switch (destination) {
        case 'adminLoginPage':
            window.location.href = 'adminLoginPage.php';  // Updated path
            break;
        case 'adminRegistrationPage':
            window.location.href = 'adminLoginPage.php';  // Updated path
            break;
        case 'adminDashboard':
            window.location.href = 'adminDashboard.php';  // Updated path
            break;
        case 'userList':
            window.location.href = 'userList.php';  // Updated path
            break;
        case 'propertyList':
            window.location.href = 'propertyList.php'; 
            break;
        case 'approvalList':
            window.location.href = 'approvalList.php'; 
            break;
        default:
            console.error('Invalid destination: ' + destination);
    }
}
