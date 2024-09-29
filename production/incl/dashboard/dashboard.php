
<div class="row col-md-12 col-sm-12" style="display: inline-block;" >
  <div class="row">
    <div class="animated flipInY col-lg-4 col-md-4 col-sm-6  ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-users"></i>
        </div>
        <div class="count" id="userCount">Loading ... </div>
        <h3>Users</h3>
      </div>
    </div>
    <div class="animated flipInY col-lg-4 col-md-4 col-sm-6  ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-shopping-cart"></i>
        </div>
        <div class="count" id="product_count">Loading ... </div>
        <h3>Products</h3>
      </div>
    </div>
    <div class="animated flipInY col-lg-4 col-md-4 col-sm-6  ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-shopping-bag"></i>
        </div>
        <div class="count" id="orderCount">Loading ...</div>
        <h3>Orders</h3>
      </div>
    </div>
                      
                      <!-- <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                          </div>
                          <div class="count">179</div>
                          <h3></h3>
                        </div>
                      </div> -->
  </div>
  <div class="row ">
    <div class="col-md-6 card">
      <div id="barchart" ></div>
    </div>
    <div class="col-md-6 card">
        <canvas id="barGraphMonth" width="400" height="400"></canvas>
    </div>    
  </div>

  <div class="row">
    <div class="col-md-6 mt-3 mb-3 card">
      <h2>Top 10 Customers</h2>
      <div id="progressContainer" class="m-3">
          <!-- Progress bars will be added here dynamically -->
      </div>
      <a href="index?link=dashboard&dash=costumer" class="mb-3" style="text-align: right">See more!</a>
    </div>
    <div class="col-md-6 mt-3 mb-3 card">
      <h2>Top 10 Products Sold</h2>
      <div id="ProductsPogress" class="m-3">
          <!-- Progress bars will be added here dynamically -->
      </div>
      <a href="" class="mb-3" style="text-align: right">See more!</a>
    </div>
  </div>
   