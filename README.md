# **Coding Test : Management Work Order - Manufacturing**
Membuat aplikasi web untuk mengelola work order dalam proses manufaktur, termasuk pembuatan, pelacakan, dan pembaruan work order dengan role-based access control (RBAC).

---

# **Table Of Content**

| Content                             |
| ----------------------------------- |
| [Techstack](#techstack)             |
| [Dokumentasi API](#dokumentasi-api) |
| Setup Backend                       |
| Setup Frontend                      |

---

# **Techstack**
| Front end    | Back end   |
| ------------ | ---------- |
| React        | Laravel 12 |
| Typescript   | sanctum    |
| Tailwind CSS |            |

---

# **Dokumentasi-Api**

## Autentikasi

### **1. Register**

Endpoint: `POST /api/register`

Headers: `Accept : application/json`

Request Body:

```json
{
  "name": "contoh operator",
  "email": "contoh@operator.com",
  "password": "operator2727",
  "role": 1 
}
// 1 : production management
// 2 : operator
```

Response:

```json
{
    "success": true,
    "message": "Register Success",
    "data": {
        "token": "1|contohTokenMGio6D4PQP2Uh6bhJtM898b0c65",
        "token_type": "Bearer",
        "expired_at": "2025-03-03 03:58:17"
    }
}
```

---

### **2. Login**

Endpoint: `POST /api/login`

Headers: `Accept : application/json`

Request Body:

```json
{
  "email": "contoh@operator.com",
  "password": "operator2727"
}
```

Response:

```json
{
    "success": true,
    "message": "Login Success",
    "data": {
        "token": "2|contohToken35YawLB3Pv2DEYJ2W5c3aac433",
        "token_type": "Bearer",
        "expired_at": "2025-03-03 04:02:37"
    }
}
```

---

### **3. Logout**

Endpoint: `DELETE /api/logout`

Headers:

```json
{
  "Authorization": "Bearer 1|contohTokenMGio6D4PQP2Uh6bhJtM898b0c65"
}
```

Response:

```json
{
    "success": true,
    "message": "Logout Success",
    "data": []
}
```

## Workorder

### **4. Logout**

Endpoint: `DELETE /api/logout`

Headers:

```json
{
  "Authorization": "Bearer 1|contohTokenMGio6D4PQP2Uh6bhJtM898b0c65"
}
```

Response:

```json
{
    "success": true,
    "message": "Logout Success",
    "data": []
}
```

