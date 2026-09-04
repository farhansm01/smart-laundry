<!-- SECTION 1: PRESS LAUNDRY ORDER FORM COMPONENT -->
<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../models/ServiceModel.php';
$form_services = getAllServices($conn);
?>
<section id="press-order" class="dashboard-section">
    <div class="section-title-box">
        <h2><i class="fa-solid fa-pen-to-square"></i> Press Laundry Order Form</h2>
        <p>Select clothes, choose service types, enter numbers, and submit into one order.</p>
    </div>

    <!-- Single Order Form -->
    <form method="POST" action="" id="orderForm">
        <input type="hidden" name="items_json" id="itemsJsonInput" value="[]">

        <!-- FORM-TYPE UI: Clothes & Services Selection Table -->
        <div class="checkout-card" style="margin-bottom: 25px;">
            <h3 class="checkout-title"><i class="fa-solid fa-shirt"></i> 1. Select Clothes, Services & Quantities</h3>

            <div style="overflow-x: auto;">
                <table class="form-order-table">
                    <thead>
                        <tr>
                            <th>Clothes Name</th>
                            <th>Service Type</th>
                            <th>Price / Unit</th>
                            <th style="width: 130px;">Number (Qty)</th>
                            <th style="text-align: right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($form_services as $srv): ?>
                            <tr class="form-item-row" data-name="<?php echo htmlspecialchars($srv['item_name']); ?>" data-price="<?php echo $srv['price']; ?>">
                                <td>
                                    <i class="fa-solid <?php echo htmlspecialchars($srv['icon'] ?? 'fa-shirt'); ?>" style="color: #2b7a78; margin-right: 8px;"></i>
                                    <strong><?php echo htmlspecialchars($srv['item_name']); ?></strong>
                                </td>
                                <td>
                                    <select class="service-select">
                                        <option value="<?php echo htmlspecialchars($srv['service_type']); ?>"><?php echo htmlspecialchars($srv['service_type']); ?></option>
                                        <option value="Wash & Iron">Wash & Iron</option>
                                        <option value="Wash & Fold">Wash & Fold</option>
                                        <option value="Dry Cleaning">Dry Cleaning</option>
                                    </select>
                                </td>
                                <td><span class="price-pill">$<?php echo number_format($srv['price'], 2); ?></span></td>
                                <td>
                                    <input type="number" class="qty-input" min="0" value="0" placeholder="0">
                                </td>
                                <td style="text-align: right;"><strong class="row-subtotal">$0.00</strong></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Delivery Address & Pickup Details Card -->
        <div class="checkout-card">
            <h3 class="checkout-title"><i class="fa-solid fa-truck-ramp-box"></i> 2. Delivery & Pickup Details</h3>

            <div class="form-grid">
                <div class="form-group">
                    <label><i class="fa-solid fa-phone"></i> Phone Number</label>
                    <input type="tel" name="phone" required placeholder="+1 555-019-2834" value="+1 555-0192">
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-calendar-day"></i> Pickup Date</label>
                    <input type="date" name="pickup_date" required min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-clock"></i> Pickup Time Slot</label>
                    <select name="time_slot" required>
                        <option value="08:00 AM - 10:00 AM">08:00 AM - 10:00 AM</option>
                        <option value="10:00 AM - 12:00 PM" selected>10:00 AM - 12:00 PM</option>
                        <option value="02:00 PM - 04:00 PM">02:00 PM - 04:00 PM</option>
                        <option value="06:00 PM - 08:00 PM">06:00 PM - 08:00 PM</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label><i class="fa-solid fa-location-dot"></i> Delivery & Pickup Address</label>
                    <textarea name="address" rows="2" required placeholder="House/Apt No, Street Name, City">742 Evergreen Terrace, Apt 4B</textarea>
                </div>
            </div>

            <!-- Live Price Summary Box -->
            <div class="order-summary-box">
                <div class="summary-row">
                    <span>Selected Clothes:</span>
                    <strong id="summarySelectedItems">0 items</strong>
                </div>
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span id="summarySubtotal">$0.00</span>
                </div>
                <div class="summary-row">
                    <span>Pickup Fee:</span>
                    <span id="summaryPickupFee">$0.00</span>
                </div>
                <div class="summary-row total-row">
                    <span>Total Price:</span>
                    <strong id="summaryTotal">$0.00</strong>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="place_order" class="btn-place-order">
                <i class="fa-solid fa-paper-plane"></i> Place Order Now
            </button>
        </div>
    </form>
</section>
