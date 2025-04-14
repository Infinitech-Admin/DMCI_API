<!DOCTYPE html>
<html>
<head>
    <title>Contact Inquiry</title>
</head>
<body>
    <h1>New Contact Inquiry</h1>
    <p><strong>First Name:</strong> {{ $contactDetails['firstname'] }}</p>
    <p><strong>Last Name:</strong> {{ $contactDetails['lastname'] }}</p>
    <p><strong>Email:</strong> {{ $contactDetails['email'] }}</p>
    <p><strong>Phone Number:</strong> {{ $contactDetails['number'] }}</p>
    <p><strong>Property Name:</strong> {{ $contactDetails['property_name'] }}</p>
    <p><strong>Unit Type:</strong> {{ $contactDetails['unit_type'] }}</p>
    <p><strong>Property Location:</strong> {{ $contactDetails['property_location'] }}</p>
    <p><strong>Message:</strong> {{ $contactDetails['message'] }}</p>
</body>
</html>
