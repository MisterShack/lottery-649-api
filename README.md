# Lotto 6/49 API
This is a start to an API project that will allow users to authenticate, add funds, buy lottery tickets, and check their tickets.

Currently, the API supports checking a tickets against the WCLC Lotto 6/49 API to determine a prize amount. The prize amount is currently static and will be relative to the draw date in the future.

## Endpoints

### /api/ticket/check

- draw_date [required|format:Y-m-d|string]
- ticket_numbers [required|array<int>]
- ticket_bonus [required|integer] Ex. 32
    
**Example Request:**
```
{
    "draw_date": "2022-05-18",
    "ticket_numbers": [24, 34, 5, 15, 42, 20],
    "ticket_bonus": 32
}
```

## In Development
    - Write Tests & Validation for Ticket
    - Implement "Extra" functionality
    - Allow multiple tickets to be checked
    - Have prize amounts be related to the draw, not fixed
    
## Future Development
    - Allow user registration/login
    - Allow users to add funds
    - Allow users to buy tickets using quick pick (random numbers)
    - Allow users to buy tickets using their own selections
    - Allow users view tickets including their winning amounts
    - Allow users to check tickets by their ID
