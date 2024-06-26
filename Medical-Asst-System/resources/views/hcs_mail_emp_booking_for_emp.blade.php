<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Notification</title>
</head>
<body>
    <p>
        <strong>Subject:</strong> New Booking Notification
    </p>

    <p>
        Dear {{$empdata->emp_name}},
    </p>

    <p>
        You have a new booking request in your portal. Please log in to your account to view the details and respond to the user accordingly.
    </p>

    <p>
        Here are the basic details of the booking:
    </p>

    <ul>
        <li><strong>Booking Name:</strong>{{ $userdata->name }}</li>
        <li><strong>Service:</strong> {{ $userdata->order_type === 'A' ? 'Aya' : ($userdata->order_type === 'N' ? 'Nurse' : 'Technician') }}</li>
        <li><strong>Date & Time:</strong> {{ $userdata->created_at }}</li>
        <li><strong>Land Mark:</strong> {{ $userdata->land_mark }}</li>
        <li><strong>Location:</strong> {{ $userdata->address }}</li>
        <!-- You can add more details here -->
    </ul>

    <p>
        Please ensure to respond promptly to confirm or reject the booking and update the status in the system accordingly.
    </p>

    <p>
        If you encounter any issues or have questions, feel free to contact us at [Your Contact Information].
    </p>

    <p>
        Thank you for your attention to this matter.
    </p>

    <p>
        Best regards, <br>
        Emergency Medical Assistance System
    </p>
</body>
</html>
