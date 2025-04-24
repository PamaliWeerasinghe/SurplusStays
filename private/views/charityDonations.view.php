<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity</title>
    <link rel="stylesheet" href="<?=STYLES?>/charityDonations.css">
</head>
<body>
    <?php echo $this->view('includes/charityNavbar')?>

    <div class="container">
        <?php echo $this->view('includes/charitySidepanel')?>
        <div class="container-right">
            <div class="top-half">
            <div class="top-bar">
                </div>
                <div class="stats">
                    <div class="stat-item">                                   
                            <div class="stat-title">Total Requests</div>
                            <div class="stat-value"><?= isset($AllReqCount) ? htmlspecialchars($AllReqCount) : 0 ?></div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <div class="stat-title">Accepted</div>
                            <div class="stat-value"><?= isset($AccReqCount) ? htmlspecialchars($AccReqCount) : 0 ?></div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <div class="stat-title">Rejected</div>
                            <div class="stat-value"><?= isset($RejReqCount) ? htmlspecialchars($RejReqCount) : 0 ?></div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <div class="stat-title">No response</div>
                            <div class="stat-value"><?= isset($PenReqCount) ? htmlspecialchars($PenReqCount) : 0 ?></div>
                        </div>
                    </div>
                </div>
                <div class="complaints-status">
                    <div class="table-container">
                        <h2 style="color:black;">Sent Donation Requests</h2>
                        <div class="toggle-slider">
                            <button class="toggle-option1 active" data-status="all">All</button>
                            <button class="toggle-option1" data-status="yet-to-decide">Pending</button>
                            <button class="toggle-option1" data-status="accepted">Accepted</button>
                            <button class="toggle-option1" data-status="rejected">Rejected</button>
                        </div>
                        <table class="admin-order-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Shop</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rows): ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr
                                            data-id="<?= $row->id ?>"
                                            data-message="<?= htmlspecialchars($row->message) ?>"                           
                                            data-reply-message="<?= htmlspecialchars($row->feedback ?? '') ?>"
                                            data-products='<?= htmlspecialchars(json_encode($row->products)) ?>'
                                        >                                          
                                            <td class="date"><?= htmlspecialchars($row->date) ?></td>
                                            <td>
                                                <?php foreach ($shopRows as $shopRow): ?>
                                                    <?php if ($shopRow->id == $row->business_id): ?>
                                                        <?= htmlspecialchars($shopRow->name) ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td><?= htmlspecialchars($row->title) ?></td>
                                            <?php if(htmlspecialchars($row->status)=='accepted'): ?>
                                                <td><button class="status ongoing">Accepted</button></td>
                                            <?php elseif(htmlspecialchars($row->status)=='pending'): ?>
                                                <td><button class="status draft">Pending</button></td>
                                            <?php elseif(htmlspecialchars($row->status)=='rejected'): ?>
                                                <td><button class="status closed">Rejected</button></td>
                                            <?php endif; ?>    
                                            <td class="action">
                                                <button class="action-btn1 edit">View More</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <tr><td colspan="5"><h4>You currently have 0 donation requests.</h4></td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="stats">
                    <div class="stat-item_r">                                   
                            <div class="stat-title">Total Requests</div>
                            <div class="stat-value"><?= isset($AllReqCount_r) ? htmlspecialchars($AllReqCount_r) : 0 ?></div>
                    </div>
                    <div class="stat-item_r">
                        <div>
                            <div class="stat-title">Accepted</div>
                            <div class="stat-value"><?= isset($AccReqCount_r) ? htmlspecialchars($AccReqCount_r) : 0 ?></div>
                        </div>
                    </div>
                    <div class="stat-item_r">
                        <div>
                            <div class="stat-title">Rejected</div>
                            <div class="stat-value"><?= isset($RejReqCount_r) ? htmlspecialchars($RejReqCount_r) : 0 ?></div>
                        </div>
                    </div>
                    <div class="stat-item_r">
                        <div>
                            <div class="stat-title">No response</div>
                            <div class="stat-value"><?= isset($PenReqCount_r) ? htmlspecialchars($PenReqCount_r) : 0 ?></div>
                        </div>
                    </div>
                </div>

                <div class="complaints-status">
                    <div class="table-container">
                        <h2 style="color:black;">Recieved Donation Requests</h2>
                        <div class="toggle-slider">
                            <button class="toggle-option2 active" data-status="all">All</button>
                            <button class="toggle-option2" data-status="yet-to-decide">Yet To Decide</button>
                            <button class="toggle-option2" data-status="accepted">Accepted</button>
                            <button class="toggle-option2" data-status="rejected">Rejected</button>
                        </div>
                        <table class="admin-order-table2">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Shop</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rows_r): ?>
                                    <?php foreach ($rows_r as $row): ?>
                                        <tr 
                                            data-id="<?= $row->id ?>"
                                            data-message="<?= htmlspecialchars($row->message) ?>"
                                            data-food-items="<?= htmlspecialchars($row->food_items) ?>"
                                            data-reply-message="<?= htmlspecialchars($row->feedback ?? '') ?>"
                                           
                                        >
                                            <td class="date"><?= htmlspecialchars($row->date) ?></td>
                                            <td>
                                                <?php foreach ($shopRows as $shopRow): ?>
                                                    <?php if ($shopRow->id == $row->business_id): ?>
                                                        <?= htmlspecialchars($shopRow->name) ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </td>
                                            <td><?= htmlspecialchars($row->title) ?></td>
                                            <?php if(htmlspecialchars($row->status)=='accepted'): ?>
                                                <td><button class="status ongoing">Accepted</button></td>
                                            <?php elseif(htmlspecialchars($row->status)=='pending'): ?>
                                                <td><button class="status draft">Pending</button></td>
                                            <?php elseif(htmlspecialchars($row->status)=='rejected'): ?>
                                                <td><button class="status closed">Rejected</button></td>
                                            <?php endif; ?>    
                                            <td class="action">
                                                <button class="action-btn edit">View More</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <tr><td colspan="5"><h4>You currently have 0 donation requests.</h4></td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal HTML structure -->
    <div id="requestModal" class="modal-overlay">
        <form class="modal-container" method="POST" action="<?=ROOT?>/charity/replyDonationRequest/<?= $id ?>">
            <div class="modal-header">
            <h3 class="modal-title">Request Details</h3>
            <button type="button" class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="info-group">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span id="modal-status" class="status-badge"></span>
                    </div>
                </div>
                <div class="info-group">
                    <div class="info-label">Date</div>
                    <div id="modal-date" class="info-value"></div>
                </div>
                <div class="info-group">
                    <div class="info-label">Business</div>
                    <div id="modal-business" class="info-value"></div>
                </div>
                <div class="info-group">
                    <div class="info-label">Title</div>
                    <div id="modal-title" class="info-value"></div>
                </div>
                <div class="info-group">
                    <div class="info-label">Message</div>
                    <div id="modal-message" class="info-value"></div>
                </div>
                <div class="info-group">
                    <div class="info-label">Food Items</div>
                    <div id="modal-food-items" class="info-value"></div>
                </div>
                
                <!-- Reply message for accepted/rejected requests -->
                <div id="reply-message-container" class="reply-message" style="display: none;">
                    <div class="info-label">Reply Message</div>
                    <div id="modal-reply-message" class="info-value"></div>
                </div>

                <input type="hidden" name="status" id="status-input">
                <input type="hidden" name="donation_id" id="donation-id">
                
                <!-- Form for pending requests -->
                <div id="reply-form" class="reply-form">
                    <div class="form-group">
                    <label for="reply-message" class="form-label">Reply Message</label>
                    <textarea name="reply-message" id="reply-message" class="form-control" rows="3" placeholder="Enter your response..."></textarea>
                    </div>
                </div>
            </div>
            <div id="modal-footer" class="modal-footer">
                <button type="button" id="close-modal" class="modal-btn btn-cancel">Close</button>
                <div id="action-buttons" style="display: none;">
                    <button type="submit" name="action" value="reject" id="reject-btn" class="modal-btn btn-reject">Reject</button>
                    <button type="submit" name="action" value="accept" id="accept-btn" class="modal-btn btn-accept">Accept</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal2 HTML structure -->
    <div id="requestModal2" class="modal2-overlay">
    <div class="modal2-container"> 
        <div class="modal2-header">
        <h3 class="modal2-title">Request Details</h3>
        <button type="button" class="modal2-close">&times;</button>
        </div>
        <div class="modal2-body">
            <div class="info-group">
                <div class="info-label">Status</div>
                <div class="info-value">
                    <span id="modal2-status" class="status-badge"></span>
                </div>
            </div>
            <div class="info-group">
                <div class="info-label">Date</div>
                <div id="modal2-date" class="info-value"></div>
            </div>
            <div class="info-group">
                <div class="info-label">Business</div>
                <div id="modal2-business" class="info-value"></div>
            </div>
            <div class="info-group">
                <div class="info-label">Title</div>
                <div id="modal2-title" class="info-value"></div>
            </div>
            <div class="info-group">
                <div class="info-label">Message</div>
                <div id="modal2-message" class="info-value"></div>
            </div>
            
            <!-- New section for products -->
            <div class="info-group">
                <div class="info-label">Products</div>
                <div id="modal2-products" class="info-value products-container"></div>
            </div>
            
            <!-- Reply message for accepted/rejected requests -->
            <div id="reply-message-container2" class="reply-message" style="display: none;">
                <div class="info-label">Reply Message</div>
                <div id="modal2-reply-message" class="info-value"></div>
            </div>

            <input type="hidden" name="status" id="status-input">
            <input type="hidden" name="donation_id" id="donation-id">
            
        </div>
        <div id="modal2-footer" class="modal-footer">
            <button type="button" id="close-modal2" class="modal2-btn btn-cancel">Close</button>
        </div>
    </div>
</div>

    <?php echo $this->view('includes/footer')?>

<script>

document.addEventListener('DOMContentLoaded', function() {
  // First modal (for received requests)
  const modal = document.getElementById('requestModal');
  const closeBtn = document.querySelector('.modal-close');
  const closeBtnFooter = document.getElementById('close-modal');
  const acceptBtn = document.getElementById('accept-btn');
  const rejectBtn = document.getElementById('reject-btn');
  const actionButtons = document.getElementById('action-buttons');
  const replyForm = document.getElementById('reply-form');
  const replyMessageContainer = document.getElementById('reply-message-container');
  
  // Get all "View More" buttons for first table
  const viewMoreButtons = document.querySelectorAll('.action-btn.edit');
  
  // Add click event to each View More button
  viewMoreButtons.forEach(button => {
    button.addEventListener('click', function() {
      // finding the nearest ancestor <tr> (table row) element from the current element.
      const row = this.closest('tr');
      const date = row.querySelector('.date').textContent;
      const businessName = row.cells[1].textContent.trim();
      const title = row.cells[2].textContent.trim();
      const statusElement = row.cells[3].querySelector('button');
      const status = statusElement.textContent.toLowerCase();
      
      // Get data that's in the PHP row but not displayed in the table
      const rowData = row.dataset;
      const message = rowData.message || "No message provided.";
      const foodItems = rowData.foodItems || "None specified.";
      const replyMessage = rowData.replyMessage || "";
      const donationId = row.dataset.id;

      // Fill modal with data
      document.getElementById('donation-id').value = donationId;
      document.querySelector('.modal-container').action = `<?=ROOT?>/charity/replyDonationRequest/${donationId}`;
      document.getElementById('modal-date').textContent = date;
      document.getElementById('modal-business').textContent = businessName;
      document.getElementById('modal-title').textContent = title;
      document.getElementById('modal-message').textContent = message;
      document.getElementById('modal-food-items').textContent = foodItems;
      
      // Set status with appropriate styling
      const modalStatus = document.getElementById('modal-status');
      modalStatus.textContent = status.charAt(0).toUpperCase() + status.slice(1);
      modalStatus.className = 'status-badge';
      
      if (status === 'pending') {
        modalStatus.classList.add('status-pending');
        actionButtons.style.display = 'block';
        replyForm.style.display = 'block';
        replyMessageContainer.style.display = 'none';
      } else {
        if (status === 'accepted') {
          modalStatus.classList.add('status-accepted');
          replyMessageContainer.classList.add('reply-accepted');
        } else {
          modalStatus.classList.add('status-rejected');
          replyMessageContainer.classList.add('reply-rejected');
        }
        
        actionButtons.style.display = 'none';
        replyForm.style.display = 'none';
        
        // Show reply message for accepted/rejected requests
        document.getElementById('modal-reply-message').textContent = replyMessage || "No reply message provided.";
        replyMessageContainer.style.display = 'block';
      }    
      // Show modal
      modal.classList.add('active');
    });
  });
  
  // Close modal when clicking the X or Close button
  closeBtn.addEventListener('click', closeModal);
  closeBtnFooter.addEventListener('click', closeModal);
  
  // Close modal when clicking outside
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      closeModal();
    }
  });
  
  function closeModal() {
    modal.classList.remove('active');
  }

  acceptBtn.addEventListener('click', function() {
    document.getElementById('status-input').value = 'accepted';
  });

  rejectBtn.addEventListener('click', function() {
    document.getElementById('status-input').value = 'rejected';
  });
});



document.addEventListener('DOMContentLoaded', function() { 
  // For the second modal (action-btn1)
  const modal2 = document.getElementById('requestModal2');
  const closeBtn2 = document.querySelector('.modal2-close');
  const closeBtnFooter2 = document.getElementById('close-modal2');
  
  // Get all "View More" buttons for second table
  const viewMoreButtons2 = document.querySelectorAll('.action-btn1.edit');
  
  // Add click event to each View More button with debugging
  viewMoreButtons2.forEach(button => {
    button.addEventListener('click', function() {
      console.log('Button clicked!'); // Debug
      
      // finding the nearest ancestor <tr> (table row) element from the current element.
      const row = this.closest('tr');
      const date = row.querySelector('.date').textContent;
      const businessName = row.cells[1].textContent.trim();
      const title = row.cells[2].textContent.trim();
      const statusElement = row.cells[3].querySelector('button');
      const status = statusElement.textContent.toLowerCase();
      const replyMessageContainer = document.getElementById('reply-message-container2');
      
      console.log('Modal data:', { date, businessName, title, status }); // Debug
      
      // Get data from attributes
      const rowData = row.dataset;
      const message = rowData.message || "No message provided.";
      const replyMessage = rowData.replyMessage || "";
      const donationId = rowData.id;
      
      // Parse products data
      let products = [];
      try {
        if (rowData.products) {
          products = JSON.parse(rowData.products);
        }
      } catch (e) {
        console.error('Error parsing products:', e);
      }

      // Fill modal with data
      document.getElementById('modal2-date').textContent = date;
      document.getElementById('modal2-business').textContent = businessName;
      document.getElementById('modal2-title').textContent = title;
      document.getElementById('modal2-message').textContent = message;
      
      // Display products
      const productsContainer = document.getElementById('modal2-products');
      productsContainer.innerHTML = '';
      
      if (products && products.length > 0) {
        products.forEach(product => {
          // Get the first image if there are multiple (comma-separated)
          let imageUrl = product.pictures;
          if (imageUrl.includes(',')) {
            imageUrl = imageUrl.split(',')[0];
          }
          
          const productDiv = document.createElement('div');
          productDiv.className = 'product-item';
          const ROOT = '<?php echo ROOT; ?>';
          productDiv.innerHTML = `
            <img src="${ROOT}${imageUrl}" alt="${product.name}" class="product-image">
            <div class="product-name">${product.name}</div>
              ${product.qty ? `<div class="product-qty">${product.qty}</div>` : ''}
          `;
          
          productsContainer.appendChild(productDiv);
        });
      } else {
        productsContainer.innerHTML = '<div class="no-products">No products specified</div>';
      }
      
      // Set status with appropriate styling
      const modalStatus = document.getElementById('modal2-status');
      modalStatus.textContent = status.charAt(0).toUpperCase() + status.slice(1);
      modalStatus.className = 'status-badge';
      
      if (status === 'pending') {
        modalStatus.classList.add('status-pending');
      } else if (status === 'accepted') {
        modalStatus.classList.add('status-accepted');
      } else {
        modalStatus.classList.add('status-rejected');
      }
      
      // Show reply message if it exists
      const replyContainer = document.getElementById('reply-message-container2');
      if (replyMessage) {
        document.getElementById('modal2-reply-message').textContent = replyMessage;
        replyContainer.style.display = 'block';
      } else {
        replyContainer.style.display = 'none';
      }
      
      // Set donation ID
      document.getElementById('donation-id').value = donationId;
      
      // Show modal
      console.log('About to show modal2'); // Debug
      modal2.classList.add('active');
      console.log('Modal2 classes:', modal2.classList); // Debug
    });
  });
  
  // Close modal when clicking the X or Close button
  if (closeBtn2) {
    closeBtn2.addEventListener('click', closeModal2);
  }
  
  if (closeBtnFooter2) {
    closeBtnFooter2.addEventListener('click', closeModal2);
  }
  
  // Close modal when clicking outside
  modal2.addEventListener('click', function(e) {
    if (e.target === modal2) {
      closeModal2();
    }
  });
  
  function closeModal2() {
    modal2.classList.remove('active');
  }
});



</script>
<script src="<?=ASSETS?>/js/charityToggle.js"></script>
  
</body>
</html>