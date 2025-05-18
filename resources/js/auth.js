// // resources/js/auth.js
// const Auth = {
//   // Verifica autenticación y redirige si es necesario
//   checkAuth: () => {
//     const token = localStorage.getItem('token');

    
//     if (!token) {
//       window.location.href = '/login';
//       return false;
//     }
    
//     // if (allowedRoles) {
//     //   // Convierte a array si es un string
//     //   const rolesArray = Array.isArray(allowedRoles) ? allowedRoles : [allowedRoles];
      
//     //   if (!rolesArray.includes(userRol)) {
//     //     window.location.href = '/unauthorized';
//     //     return false;
//     //   }
//     // }
    
//     return true;
//   },

//   // Obtiene los datos del usuario
//   getUserData: () => {
//     return {
//       token: localStorage.getItem('token'),
//       userId: localStorage.getItem('userId'),
//       userRol: localStorage.getItem('userRol'),
//       nombre: localStorage.getItem('nombre')
//     };
//   },

//   // Actualiza la UI con los datos del usuario
//   updateUserUI: () => {
//     const { nombre, userRol } = Auth.getUserData();
    
    
//     if (nombre) {
//       const userNameElement = document.getElementById('user-name');
//       if (userNameElement) userNameElement.textContent = nombre;
//     }
    
//     if (userRol) {
//       const userRolElement = document.getElementById('user-rol');
//       if (userRolElement) userRolElement.textContent = userRol;
//     }
//   },

//   // Cierra la sesión
//   logout: () => {
//     localStorage.clear();
//     window.location.href = '/login';
//   }
  
// };
// // Exportación para módulos
// if (typeof module !== 'undefined' && module.exports) {
//   module.exports = { Auth };
// } else {
//   window.Auth = Auth;  // Hacerlo global para pruebas
// }