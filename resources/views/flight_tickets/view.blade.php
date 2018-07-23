<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            body {
                margin: 0;
                padding: 0;
            }
            table {
                width: 7.5in;
            }
            h1, h2, h3, h4, h5, h6, small, p, strong {
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            }
            .reference_code {
                margin-top: 0px;
                margin-bottom: 0px;
            }
            .logo {
                height: 50px;
            }
            .title {
                margin: 5px 0px 5px 0px;
            }
            .total_amount {
                display: block;
                text-align: right;
                margin: 5px 0px 0px 0px;
            }
            .paragraph {
                margin-top: 1px;
                margin-bottom: 10px;
            }
            .headline {
                text-align: center;
                margin-bottom: 10px;
            }
            small {
                font-size: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
        <h3 class="headline">FLIGHT ITENERARY TICKET</h3>
        <table>
            <tr>
                <td><img style="height: 25px" src="{{ $flight_ticket->airline_company->logo_path }}" alt=""></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><small>BOOKING REFERENCE</small></td>
            </tr>
            <tr>
                <td>
                    <small>
                        <strong>ISSUE DATE: </strong>{{ $flight_ticket->booking_date }}
                    </small>
                </td>
                <td rowspan="2"><h1 class="reference_code">{{ $flight_ticket->booking_reference }}</h1></td>
            </tr>
            <tr>
                <td>
                    <small>
                        <strong>BOOKING DATE: </strong>{{ $flight_ticket->booking_date }}
                    </small>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><small>Status: Confirmed</small></td>
            </tr>
        </table>
        <h3>Booking Details</h3>
        <table>
            <tr>
                <td>
                    <small>Booked by: Hair and Beyond Beauty Salon & Ticketing Services</small>
                </td>
                <td><small>Mobile: </small></td>
            </tr>
            <tr>
                <td><small>Address: Block3 Lot 43 Northtown Subdivision,Libertad, Butuan City Philippines 8600</small></td>
                <td><small>Email Address: madelenebt@gmail.com </small></td>
            </tr>
        </table>
        <h3 class="headline">AIRLINE DETAILS</h3>
        <table>
            <tr>
                <td colspan="4"><small><strong>Issued By</strong></small></td>
            </tr>
            <tr>
                <td rowspan="3"><img class="logo" src="{{ $flight_ticket->airline_company->logo_path }}" alt=""></td>
                <td><small>Airline PNR:</small></td>
                <td><small>Address: <strong>{{ $flight_ticket->airline_company->address }}</strong></small></td>
            </tr>
            <tr>
                <td rowspan="2"><h1 class="reference_code">{{ $flight_ticket->pnr }}</h1></td>
                <td><small>Email: <strong>{{ $flight_ticket->airline_company->email }}</strong></small></td>
            </tr>
            <tr>
                <td><small>Phone: <strong>{{ $flight_ticket->airline_company->phone_number }}</strong></small></td>
            </tr>
        </table>
        <h3 class="headline">FLIGHT DETAILS</h3>
        <table>
            <tr>
                <td><small><strong>Flight Number</strong></small></td>
                <td><small><strong>Origin</strong></small></td>
                <td><small><strong>Destination</strong></small></td>
                <td><small><strong>Departure Date</strong></small></td>
                <td><small><strong>Arrival Date</strong></small></td>
            </tr>
            <tr>
                <td><small>{{ $flight_ticket->flight_number }}</small></td>
                <td><small>{{ $flight_ticket->origin }}</small></td>
                <td><small>{{ $flight_ticket->destination }}</small></td>
                <td><small>{{ $flight_ticket->departure_date }}</small></td>
                <td><small>{{ $flight_ticket->arrival_date }}</small></td>
            </tr>
            @if(collect($flight_ticket->second_flight)->isNotEmpty()) 
            <tr>
                <td><small>{{ $flight_ticket->second_flight->flight_number }}</small></td>
                <td><small>{{ $flight_ticket->second_flight->origin }}</small></td>
                <td><small>{{ $flight_ticket->second_flight->destination }}</small></td>
                <td><small>{{ $flight_ticket->second_flight->departure_date }}</small></td>
                <td><small>{{ $flight_ticket->second_flight->arrival_date }}</small></td>
            </tr>
            @endif
        </table>
        <h3 class="headline">PASSENGER DETAILS</h3>
        <table>
            <tr>
                <td><small><strong>Name</strong></small></td>
                <td><small><strong>Ticket Number</strong></small></td>
                <td><small><strong>PAX Type</strong></small></td>
                <td><small><strong>Add-on Baggage</strong></small></td>
                <td><small><strong>Status</strong></small></td>
            </tr>
            <tr>
                <td><small>{{ $flight_ticket->passenger_name }}</small></td>
                <td><small>{{ $flight_ticket->ticket_number }}</small></td>
                <td><small>{{ $flight_ticket->pax_type }}</small></td>
                <td><small>{{ $flight_ticket->add_on_baggage }}</small></td>
                <td><small>CONFIRM</small></td>
            </tr>
            @if(collect($flight_ticket->second_flight)->isNotEmpty()) 
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><small>{{ $flight_ticket->second_flight->add_on_baggage }}</small></td>
                <td></td>
            </tr>
            @endif
        </table>
        <small class="total_amount"><strong>TOTAL AMOUNT</strong></small>
        <h2 class="total_amount">PHP {{ $flight_ticket->total_amount }}</h2>
        <br>
        <h5 style="margin-top: 0px; margin-bottom: 0px;">RULES AND REGULATIONS</h5>
        <small><strong>Check-in and Boarding Guidelines</strong></small>
        <p class="paragraph"><small>Check-in counters open 2 hours before scheduled time of flight departure and strictly close 45 minutes before flight departure. A confirmed booking shall be cancelled and released to waitlisted guests if you fail to check-in within the prescribed time. You must be at the boarding gate at least 30 minutes before flight departure as we close the gate 15 minutes before flight departure. Guests not at the boarding gate at the prescribed time will not be allowed to board the aircraft. </small></p>
        <small><strong>Baggage Information</strong></small>
        <p class="paragraph"><small>Only 1 piece of baggage is allowed to be carried on board provided that it does not exceed the dimensions 56cm x 36cm x 23cm for Airbus flights and 56cm x 35cm x 20cm for ATR flights. It should not weigh more than 7kg for all flights except in Caticlan which has a maximum hand baggage weight of 5kg. Items determined by us to be of excessive weight or size or of an offensive nature will not be permitted on-board.</small></p>
        <small><strong>Travel Documents</strong></small>
        <p class="paragraph"><small>You are solely responsible to secure and comply with the immigration, customs, travel and legal requirements of your destination country. Since we are a point-to-point carrier, we will not accept guests transiting without visa and will not be responsible for any connecting flight arrangement you may choose to make.</small></p>
        <small><strong>Online Booking Cut-off</strong></small>
        <p class="paragraph"><small>Internet bookings are not permitted within 3 hours and 59 minutes from the scheduled time of departure. If you wish to travel within this time, you may contact our Call Center at (+632) 70-20-888 or (+6332) 230-8888 to check availability of your preferred flight. Booking can only be done at our sales offices or airport sales counters</small></p>
    </div>
    </body>
</html>