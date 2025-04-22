# Motion API Documentation

## Overview

This document provides documentation for the Motion API endpoints, authentication methods, and data models. The API is built using Laravel and follows RESTful principles.

## Base URL

```
http://localhost:8001/api
```

## Authentication

The API uses token-based authentication for protected endpoints.

**Authentication Header:**

```
Authorization: Bearer {your_access_token}
```

To get an access token, use the login endpoint.

## API Endpoints

### Authentication

#### Get User
- **URL**: `/user`
- **Method**: `GET`
- **Auth Required**: Yes
- **Description**: Returns the currently authenticated user's details
- **Success Response**:
  - **Code**: 200
  - **Content**:
    ```json
    {
      "id": 1,
      "name": "User Name",
      "email": "user@example.com",
      "created_at": "2025-01-01T00:00:00.000000Z",
      "updated_at": "2025-01-01T00:00:00.000000Z"
    }
    ```

### Recruitation

#### Check Recruitation Status
- **URL**: `/recruitation/check/{nim}`
- **Method**: `GET`
- **Auth Required**: No
- **URL Params**: 
  - **Required**: `nim=[string]` - Student ID number
- **Description**: Checks the recruitment status of a student based on their NIM
- **Success Response**:
  - **Code**: 200
  - **Content**:
    ```json
    {
      "message": "You have been accepted!",
      "status": 200
    }
    ```
    OR
    ```json
    {
      "message": "You have not been accepted!",
      "status": 200
    }
    ```
    OR
    ```json
    {
      "message": "You have not been accepted yet!",
      "status": 200
    }
    ```
- **Error Response**:
  - **Code**: 404
  - **Content**:
    ```json
    {
      "message": "Recruitation not found"
    }
    ```

#### Submit Recruitation Application
- **URL**: `/recruitation`
- **Method**: `POST`
- **Auth Required**: No
- **Data Params**:
  ```json
  {
    "email": "example@student.telkomuniversity.ac.id",
    "name": "Applicant Name",
    "nim": "1234567890",
    "ksm": "KSM document link",
    "cv": "CV document link",
    "motivation_letter": "Motivation letter link",
    "major": "Computer Science",
    "generation": 2025,
    "division": "Web Development",
    "share_poster": "Poster sharing evidence link",
    "whatsapp": "WhatsApp number",
    "yt_evidence": "YouTube evidence link",
    "linkedin_evidence": "LinkedIn evidence link",
    "line_evidence": "LINE evidence link",
    "instagram_evidence": "Instagram evidence link",
    "twibbon_evidence": "Twibbon evidence link"
  }
  ```
- **Description**: Submits a new recruitment application
- **Success Response**:
  - **Code**: 201
  - **Content**:
    ```json
    {
      "message": "Registration success!",
      "status": 201
    }
    ```
- **Error Response**:
  - **Code**: 422
  - **Content**:
    ```json
    {
      "success": false,
      "message": "Validation failed!",
      "errors": {
        "email": ["The email must be a valid email address."],
        "..." : ["..."]
      }
    }
    ```

## Data Models

### Recruitation Model

| Field                | Type    | Description                               |
|----------------------|---------|-------------------------------------------|
| id                   | Integer | Unique identifier                         |
| email                | String  | Applicant's email (must be from telkomuniversity.ac.id) |
| name                 | String  | Applicant's full name                     |
| nim                  | String  | Student ID number                         |
| ksm                  | String  | KSM document link                         |
| cv                   | String  | CV document link                          |
| portofolio           | String  | Portfolio link (optional)                 |
| motivation_letter    | String  | Motivation letter link                    |
| major                | String  | Applicant's major                         |
| generation           | Integer | Applicant's generation/batch year         |
| division             | String  | Applied division                          |
| is_accepted          | Integer | Status: 0=pending, 1=accepted, 2=rejected, 3=in-review |
| share_poster         | String  | Proof of sharing poster                   |
| whatsapp             | String  | Applicant's WhatsApp number               |
| yt_evidence          | String  | YouTube evidence link                     |
| linkedin_evidence    | String  | LinkedIn evidence link                    |
| line_evidence        | String  | LINE evidence link                        |
| instagram_evidence   | String  | Instagram evidence link                   |
| twibbon_evidence     | String  | Twibbon evidence link                     |
| created_at           | DateTime| Record creation timestamp                 |
| updated_at           | DateTime| Record update timestamp                   |

### User Model

| Field                | Type    | Description                               |
|----------------------|---------|-------------------------------------------|
| id                   | Integer | Unique identifier                         |
| name                 | String  | User's full name                          |
| email                | String  | User's email address                      |
| email_verified_at    | DateTime| Email verification timestamp              |
| password             | String  | Hashed password                           |
| remember_token       | String  | Token for "remember me" functionality     |
| created_at           | DateTime| Record creation timestamp                 |
| updated_at           | DateTime| Record update timestamp                   |

## Error Codes

| Code | Description           |
|------|-----------------------|
| 200  | OK                    |
| 201  | Created               |
| 400  | Bad Request           |
| 401  | Unauthorized          |
| 403  | Forbidden             |
| 404  | Not Found             |
| 422  | Validation Error      |
| 500  | Internal Server Error |

## API Response Format

All API responses follow a consistent format:

```json
{
  "success": true|false,
  "message": "A message describing the result",
  "data": {
    // Response data (if applicable)
  },
  "errors": {
    // Validation errors (if applicable)
  }
}
```

## Notes for Developers

1. All dates are returned in ISO 8601 format (YYYY-MM-DDTHH:MM:SS.mmmZ)
2. Validation errors will return with a 422 status code and include specific field errors
3. Email addresses for registration must be from the telkomuniversity.ac.id domain
4. Authentication token expiration is set to 60 minutes